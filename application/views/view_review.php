<script type="text/javascript">
    $(function() {
        $('#star-rating').starrating();
        $('#star-rating').starrating({
            showText: false
        });
    });
</script>

<div id="container" style="width:50%">
	<h1>Rate and Review Our Fundraisers!</h1>

	<?php echo form_open('review', 'id="reviewForm"'); ?>
	<div id="body">

    	<?php echo validation_errors('<div class="text-danger" style="font-weight: bolder">', '</div>'); ?>
        <br />
        <?php
        foreach($fundraisers as $fundraiser) {
			$fr_options[$fundraiser['idFundraiser']] = $fundraiser['FundraiserName'];
        }
        $email = array(
            'type'          => 'email',
			'class'         => 'form-control',
			'name'          => 'email',
			'id'            => 'email',
			'placeholder'   => 'johndoe@somedomain.com',
			'maxlength'     => '100',
			'size'          => '50',
			'value'         => set_value('email'),
			'style'         => 'width:50%'
		);
        $review_text = array(
			'type'          => 'textarea',
			'class'         => 'form-control',
			'name'          => 'review',
			'id'            => 'review',
			'placeholder'   => 'Review us in our words',
			'rows'          => '5',
            'cols'          => '40',
			'value'         => set_value('textarea'),
			'style'         => 'width:50%'
        );
        $name = array(
			'type'          => 'text',
			'class'         => 'form-control',
			'name'          => 'name',
			'id'            => 'name',
			'placeholder'   => 'Your name',
			'value'         => set_value('name'),
        );
		$other = array(
			'type'          => 'text',
			'class'         => 'form-control',
			'name'          => 'other',
			'id'            => 'other',
			'placeholder'   => 'New Fundraiser',
			'value'         => set_value('other'),
		);
		$submitbtn = array(
            'type'          => 'submit',
			'value'         => 'Submit',
			'class'         => 'btn btn-primary',
			'name'          => 'submit',
			'id'            => 'submit',
		);
		$resetbtn =array(
			'type'          => 'reset',
			'value'         => 'Clear',
			'class'         => 'btn btn-primary',
			'name'          => 'clear',
			'id'            => 'clear',
		);
		$cancel = array(
			'type'          => 'button',
			'value'         => 'Cancel',
			'class'         => 'btn btn-primary',
			'name'          => 'cancel',
			'id'            => 'cancel',
            'onclick'       => "window.location='".site_url('home')."'",
		);
        ?>
        <div class="form-group">
                <label for="fundraiser">Select Fundraiser</label>
                <?php
                $value = $this->input->post('fundraiser');
                if ($value===NULL)
                    $value = '';
                echo form_dropdown('fundraiser', $fr_options, $value, array('id'=>'fundraiser')); ?>
        </div>
        <div class="form-group">
            <label for="other">Other Fundraiser (if not in table)</label>
            <?php echo form_input($other);?>
        </div>
        <div class="form-group">
                <label for="name">Please enter your name:</label>
                <?php echo form_input($name);?>
        </div>
        <div class="form-group">
            <label for="email">Your email address:</label>
            <?php echo form_input($email)?>
        </div>
        <div class="form-group">
            <label for="review">Please tell us what you think in your own words:</label>
			<?php echo form_textarea($review_text)?>
        </div>
        <div class="form-group">
            <select id="star-rating" name="starz">
                <option value="5">Excellent</option>
                <option value="4">Very Good</option>
                <option value="3">Average</option>
                <option value="2">Poor</option>
                <option value="1">Terrible</option>
            </select>
        </div>
        <?php echo form_submit($submitbtn); ?>
		<?php echo form_reset($resetbtn); ?>
		<?php echo form_input($cancel); ?>
	</div>
    <?php echo form_close(); ?>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
