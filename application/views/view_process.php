<?php
$btnReview = array(
    'name'          => 'review',
    'id'            => 'review',
    'class'         => 'btn btn-primary',
    'value'         => 'true',
    'type'          => 'button',
    'content'       => 'Add Your Review',
    'onclick'       => "window.location='".site_url('review')."'"
);
?>

<div id="container" style="width: 50%">
	<h1>Rate and Review Our Fundraisers!</h1>
	<div id="body">
        <script type="text/javascript">
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            })
        </script>
        <div  style="height:550px; width: 95%;overflow: auto;">
            <div class="text-success" style="font-weight: bolder"><?php echo $msg;?></div>
        <table class="table table-hover table-sm  table-info table-striped ">
            <thead class="thead-dark">
            <tr>
            <th colspan="2" scope="col" class="bg-success" style="text-align: center">
                <h3>Our Fundraisers</h3>
            </th>
            </tr>
            <tr>
            <th scope="col">School Fundraiser</th>
            <th scope="col">Average Rating</th>
            </tr>
           </thead>
            <tbody>
        <?php foreach($fundraisers as $fundraiser) {?>
            <tr>
                <td>
                <?php
                echo $fundraiser['FundraiserName'];
                    ?>
                </td>
                <td>
                <?php
				echo number_format($fundraiser['reviews'], 2);
                    ?>
                </td>
            </tr>
        <?php } ?>
            </tbody>
        </table>

        </div>
        <div>
            <br />
			<?php
			echo form_button($btnReview);
			?>
        </div>
    </div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
