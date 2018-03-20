<table border="1px solid black">

    <?php

    include('dbcon.php');




        $qry="SELECT * FROM `lostfound` WHERE `category`='document' and `status`='found'";

        $run = mysqli_query($con,$qry);

        if(mysqli_num_rows($run)<1)
        {
            echo "<tr><td colspan='7' align='center'><h2>No Records Avialable</h2></td></tr>";
        }

        else
        {
            $count=0;
            while($data=mysqli_fetch_assoc($run))
            {
                $count++;
                ?>

                  <tr> <td rowspan="5"><h2><?php echo $count; ?></h2></td></tr>
              <tr>  <td rowspan="5"><h2><?php echo "photo"; ?></h2></td></tr>
              <tr>  <td><h2><?php echo "Location Where Item Found : - ".$data['location']; ?></h2></td></tr>
                <tr><td><h2><?php echo "Contact Person : - ".$data['contact']; ?></h2></td></tr>
                <tr><td rowspan="2"><h2><?php echo "Description about Found Item : - ".$data['description']; ?></h2></td></tr>



                <?php

            }


    }

    ?>
</table>
