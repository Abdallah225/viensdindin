<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<form method="post" action="<?php echo base_url();?>index.php?admin/faq_create">
					<div class="row">
						<div class="col-8">
							<div class="form-group mb-3">
			                    <label for="question">Faq Question</label>
			                    <input type="text" class="form-control" id = "question" name="question">
			                </div>

							<div class="form-group mb-3">
			                    <label for="answer">Faq Reponse</label>
								<textarea class="form-control" id="answer" name="answer" rows="6"></textarea>
			                </div>

							<div class="form-group">
								<input type="submit" class="btn btn-success" value="Créer">
								<a href="<?php echo base_url();?>index.php?admin/faq_list" class="btn btn-secondary">Retour</a>
							</div>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
