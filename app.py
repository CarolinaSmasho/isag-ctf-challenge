from flask import Flask, render_template, make_response, request, redirect, url_for
from markupsafe import Markup
from bot import *
from urllib.parse import urlparse
from sqlite3 import *

app = Flask(__name__)
db_path = "./data.db"
conn = connect(database=db_path, check_same_thread=False)


@app.route("/")
def index():
    return render_template("index.html")


@app.route("/reflected")
def reflected():
    if request.args.get("query"):
        args = request.args.get("query")
        marked = Markup(args)
        return render_template("reflected.html", query=marked)

    return render_template("reflected.html")


def get_comments():
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM comments")
    comments = cursor.fetchall()
    # allow xss
    comments = [(c[0], c[1], Markup(c[2])) for c in comments]
    return comments


@app.route("/stored", methods=["GET", "POST"])
def stored():
    if request.method == "GET":
        comments = get_comments()

        return render_template("stored.html", comments=comments)

    elif request.method == "POST":
        comment = request.form.get("comment")
        cursor = conn.cursor()

        try:
            cursor.execute(
                "INSERT INTO comments (user, comment) VALUES (?,?)",
                ("anonymous", comment),
            )
            conn.commit()
            comments = get_comments()

            return render_template(
                "stored.html", comments=comments, result="Comment added successfully"
            )
        except Exception as e:
            print(e)
            return render_template("stored.html", result="Failed to add comment")


@app.route("/clear", methods=["POST"])
def delete_comment():
    cursor = conn.cursor()
    cursor.execute("DELETE FROM comments WHERE user='anonymous'")
    conn.commit()
    comments = get_comments()
    return redirect(url_for("stored"))


@app.route("/send_message")
def report():
    return render_template("report.html")


@app.route("/send_message", methods=["POST"])
def send_message():
    bot = Bot()
    url = request.form.get("message")

    if url:
        try:
            parsed_url = urlparse(url)
        except:
            return render_template("report.html", result="Invalid URL")
        if parsed_url.scheme not in ["http", "https"]:
            return render_template("report.html", result="Invalid scheme")
        if parsed_url.hostname not in ["127.0.0.1", "localhost"]:
            return render_template("report.html", result="Invalid hostname")

        try:
            bot.visit(url)
        except:
            return render_template("report.html", result="Failed to visit URL")
        bot.close()

        return render_template("report.html", result=f"Visited {parsed_url}")
    else:
        return render_template("report.html", result="URL is required")


@app.errorhandler(404)
def not_found(error):
    return make_response("Page not found", 404)


if __name__ == "__main__":
    app.run(debug=True)
