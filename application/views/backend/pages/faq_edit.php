<?php
	$faq_detail = $this->db->get_where('faq',array('faq_id'=>$faq_id))->row();
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<form method="post" action="<?php echo base_url();?>index.php?admin/faq_edit/<?php echo $faq_id;?>">
					<div class="row">
						<div class="col-8">
							<div class="form-group mb-3">
			                    <label for="question">Question Faq</label>
			                    <input type="text" class="form-control" id = "question" name="question" value="<?php echo $faq_detail->question;?>">
			                </div>

							<div class="form-group mb-3">
			                    <label for="answer">Réponse Faq</label>
								<textarea class="form-control" id="answer" name="answer" rows="6"><?php echo $faq_detail->answer;?></textarea>
			                </div>

							<div class="form-group">
								<input type="submit" class="btn btn-success" value="Mettre à jour">
								<a href="<?php echo base_url();?>index.php?admin/faq_list" class="btn btn-secondary">Retour</a>
							</div>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
