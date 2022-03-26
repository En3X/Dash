<?php
        $conn = new mysqli('localhost','root','','dash');

    try {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }else{
            ?>
<script>
console.log("Connection to database successful");
</script>
<?php
        }
    } catch (Exception $e) {
        ?>
<script>
console.error("Connection to database failed");
console.error('Error: ' + <?php echo $e->getMessage?>);
</script>
<?php
    }
?>