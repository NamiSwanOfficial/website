    <section class="leFooter mt-5" style="background-color: #0f0f10">
        <div class="container mt-5">
            <footer class="py-3">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    <li class="nav-item"><a href="./tos.php" class="nav-link textFooter px-2">Terms of Service</a></li>
                    <li class="nav-item"><a href="./pp.php" class="nav-link textFooter px-2">Privacy Policy</a></li>
                </ul>
                <p class="text-center textWhite ">© <span id="year"></span> NamiSwan, All rights reserved.</p>
            </footer>
        </div>
    </section>

    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>