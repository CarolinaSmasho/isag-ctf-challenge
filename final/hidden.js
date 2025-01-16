function getFlag() {
    fetch('api.php?key=secretKey')  
        .then(response => response.json())
        .then(data => {
            if (data.flag) {
                alert('Flag: ' + data.flag);  
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error fetching flag:', error);
        });
}