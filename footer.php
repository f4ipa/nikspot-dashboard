    
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll("button").forEach(button => {
                    button.addEventListener("click", function() {
                        document.documentElement.style.cursor = "wait";                        
                        document.body.style.cursor = "wait";
                        this.style.cursor = "wait";
                        //this.disabled = true;
                    });
                });
            });
        </script>
    </div>
</body>
</html>