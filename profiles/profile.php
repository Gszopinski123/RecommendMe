<!DOCTYPE html>
    <html>
        <head>
        
        </head>
        <body>
            <?php
                $userId = $_REQUEST['user'];
                echo $userId;
                
            ?>
            <p id ="json"></p>
            <script>
                fetch('../userData/app.json')
            .then(response => response.json())
            .then(data => document.getElementById("json").innerHTML = data['read'])
            .catch(error => console.error('Error fetching JSON:', error))
            

            </script>
</body>
</html>