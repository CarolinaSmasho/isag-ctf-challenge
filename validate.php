<?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $input = $_POST["comment"];

                // ตรวจสอบคำตอบ
                $flag = "ISAG_CTF{ํYaerin_was_taken}";
                if ($input === $flag) {
                    echo "Correct! The flag is $flag";
                } else {
                    echo "Incorrect answer!";
                }
            }
        ?>