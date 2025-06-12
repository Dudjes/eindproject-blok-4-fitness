<footer>
    <div class="footer-column">
        <h3>Pages</h3>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="workouts.php">Workouts</a></li>
        </ul>
    </div>
    <div class="footer-column">
        <h3>Contact</h3>
        <ul>
            <li><a href="#">Contact</a></li>
            <li><a href="overons.php">Over ons</a></li>
        </ul>
    </div>
    <div class="footer-column">
        <h3>Account</h3>
        <ul>
            <li><a href="register.php">Registreer</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>
    <div class="footer-column">
        <h3>Timer</h3>
        <span id="timer">00:00</span>
    </div>
    <script>
        let seconden = 0;
        let minuten = 0;

        function updateTimer() {
            seconden++;
            if (seconden === 60) {
                minuten++;
                seconden = 0;
            }
            let minStr = String(minuten).padStart(2, '0');
            let secStr = String(seconden).padStart(2, '0');
            document.getElementById('timer').textContent = minStr + ":" + secStr;
        }
        setInterval(updateTimer, 1000);
    </script>
</footer>