<?php
	$movie_detail = $this->db->get_where('movie',array('movie_id'=>$movie_id))->row();
?>
<form method="post" action="<?php echo base_url();?>index.php?admin/movie_edit/<?php echo $movie_id;?>" enctype="multipart/form-data">
	<div class="row">
	    <div class="col-6">
	        <div class="card">
	            <div class="card-body">
					<div class="form-group mb-3">
	                    <label for="simpleinput1">Titre du film</label>
	                    <input type="text" class="form-control" id = "simpleinput1" name="title" value="<?php echo $movie_detail->title;?>">
	                </div>
					<div class="form-group mb-3">
	                    <label for="url">Url de la bande annonce</label>
						<span class="help">- Vimeo ou n'importe quelle vidéo hébergée</span>
	                    <input type="text" class="form-control" name="trailer_url" id="trailer_url" value="<?php echo $movie_detail->trailer_url;?>">
	                </div>
					<div class="form-group mb-3">
	                    <label for="url">Url de la Video</label>
						<span class="help">- Vimeo ou n'importe quelle vidéo hébergée</span>
	                    <input type="text" class="form-control" name="url" id="url" value="<?php echo $movie_detail->url;?>">
	                </div>
					<div class="form-group mb-3">
	                    <label for="">Title</label>
						<span class="help">- Image pour le titre</span>
	                    <input type="file" class="form-control" name="title">
	                </div>
					<div class="form-group mb-3">
	                    <label for="">Thumbnail</label>
						<span class="help">- Image de l'icône du film</span>
	                    <input type="file" class="form-control" name="thumb">
	                </div>

					<div class="form-group mb-3">
	                    <label for="">Poster</label>
						<span class="help">- Image de bannière du film</span>
	                    <input type="file" class="form-control" name="poster">
	                </div>

					<div class="form-group mb-3">
						<label for="description_long">Longue  description</label>
						<textarea class="form-control" id="description_long" name="description_long" rows="6"><?php echo $movie_detail->description_short;?></textarea>
					</div>

					<div class="form-group mb-3">
						<label for="description_short">Brève description</label>
						<textarea class="form-control" id="description_short" name="description_short" rows="6"><?php echo $movie_detail->description_long;?></textarea>
					</div>

					<div class="form-group mb-3">
						<label for="actors">Acteur</label>
						<span class="help">- selectionner les acteurs</span>
						<select class="form-control select2" id="actors" multiple name="actors[]">
							<?php
								$actors	=	$this->db->get('actor')->result_array();
								foreach ($actors as $row2):?>
							<option
								<?php
									$actors	=	$movie_detail->actors;
									if ($actors != '')
									{
										$actor_array	=	json_decode($actors);
										if (in_array($row2['actor_id'], $actor_array))
											echo 'selected';
									}
									?>
								value="<?php echo $row2['actor_id'];?>">
								<?php echo $row2['name'];?>
							</option>
							<?php endforeach;?>
						</select>
					</div>

					<div class="form-group mb-3">
						<label for="genre_id">Genre</label>
						<span class="help">- Choix du genre</span>
						<select class="form-control select2" id="genre_id" name="genre_id">
							<?php
								$genres	=	$this->crud_model->get_genres();
								foreach ($genres as $row2):?>
							<option
								<?php if ( $movie_detail->genre_id == $row2['genre_id']) echo 'selected';?>
								value="<?php echo $row2['genre_id'];?>">
								<?php echo $row2['name'];?>
							</option>
							<?php endforeach;?>
						</select>
					</div>

					<div class="form-group mb-3">
						<label for="year">Année de publication</label>
						<select class="form-control select2" id="year" name="year">
							<?php for ($i = date("Y"); $i > 2000 ; $i--):?>
							<option
								<?php if ( $movie_detail->year == $i) echo 'selected';?>
								value="<?php echo $i;?>">
								<?php echo $i;?>
							</option>
							<?php endfor;?>
						</select>
					</div>
					<div class="form-group mb-3">
	                    <label for="">Durée du film</label>
						<span class="help">- La durée que prend le film</span>
	                    <input type="time" class="form-control" name="time">
	                </div>
					<div class="form-group mb-3">
					<label for="rating">Emplacement</label>
						<span class="help">- 0 pour classement horitontal</span>
						<span class="help">- 1 pour classement vertical </span>
						<select class="form-control select2" id="rating" name="rating">
							<?php for ($i = 0; $i <= 1 ; $i++):?>
							<option
								<?php if ( $movie_detail->rating == $i) echo 'selected';?>
								value="<?php echo $i;?>">
								<?php echo $i;?>
							</option>
							<?php endfor;?>
						</select>
					</div>

					<div class="form-group mb-3">
						<label for="featured">En vedette</label>
						<span class="help">- Le film en vedette sera montré dans la page d'accueil</span>
						<select class="form-control select2" id="featured" name="featured">
							<option value="0" <?php if ( $movie_detail->featured == 0) echo 'selected';?>>Non</option>
							<option value="1" <?php if ( $movie_detail->featured == 1) echo 'selected';?>>Oui</option>
						</select>
					</div>
	            </div>
	        </div>
	    </div>
			<div class="col-6">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Aperçu:</label>

								<!-- DEBUT DE GENERATEUR VIDEO -->
								<?php if (video_type($movie_detail->url) == 'youtube'): ?>
									<!------------- PLYR.IO ------------>
									<link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">

									<div class="plyr__video-embed" id="player">
									    <iframe src="<?php echo $movie_detail->url;?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
									</div>

									<script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
									<script>const player = new Plyr('#player');</script>

									<!------------- PLYR.IO ------------>
								<?php elseif (video_type($movie_detail->url) == 'vimeo'):
									$vimeo_video_id = get_vimeo_video_id($movie_detail->url); ?>
									<link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">

									<div class="plyr__video-embed" id="player">
									    <iframe src="https://player.vimeo.com/video/<?php echo $vimeo_video_id; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
									</div>

									<script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
									<script>const player = new Plyr('#player');</script>
								<?php else :?>
									<link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
									<video poster="<?php echo $this->crud_model->get_thumb_url('movie' , $movie_detail->movie_id);?>" id="player" playsinline controls>
									<?php if (get_video_extension($movie_detail->url) == 'mp4'): ?>
										<source src="<?php echo $movie_detail->url; ?>" type="video/mp4">
									<?php elseif (get_video_extension($movie_detail->url) == 'webm'): ?>
										<source src="<?php echo $movie_detail->url; ?>" type="video/webm">
									<?php else: ?>
										<h4><?php get_phrase('video_url_is_not_supported'); ?></h4>
									<?php endif; ?>
									</video>

									<script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
									<script>const player = new Plyr('#player');</script>
								<?php endif; ?>
								<!-- FIN GENERATEUR DE LECTEUR VIDEO -->

							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Bande annonce:</label>

								<!-- DEBUT DE GENERATEUR VIDEO -->
								<?php if (video_type($movie_detail->trailer_url) == 'youtube'): ?>
									<!------------- PLYR.IO ------------>
									<link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">

									<div class="plyr__video-embed" id="trailer_player">
									    <iframe src="<?php echo $movie_detail->trailer_url;?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
									</div>

									<script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
									<script>const trailer = new Plyr('#trailer_player');</script>

									<!------------- PLYR.IO ------------>
								<?php elseif (video_type($movie_detail->trailer_url) == 'vimeo'):
									$vimeo_video_id = get_vimeo_video_id($movie_detail->trailer_url); ?>
									<link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">

									<div class="plyr__video-embed" id="trailer_player">
									    <iframe src="https://player.vimeo.com/video/<?php echo $vimeo_video_id; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
									</div>

									<script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
									<script>const trailer = new Plyr('#trailer_player');</script>
								<?php else :?>
									<link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
									<video poster="<?php echo $this->crud_model->get_thumb_url('movie' , $movie_detail->movie_id);?>" id="trailer_player" playsinline controls>
									<?php if (get_video_extension($movie_detail->trailer_url) == 'mp4'): ?>
										<source src="<?php echo $movie_detail->trailer_url; ?>" type="video/mp4">
									<?php elseif (get_video_extension($movie_detail->trailer_url) == 'webm'): ?>
										<source src="<?php echo $movie_detail->url; ?>" type="video/webm">
									<?php else: ?>
										<h4><?php get_phrase('video_url_is_not_supported'); ?></h4>
									<?php endif; ?>
									</video>

									<script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
									<script>const trailer = new Plyr('#trailer_player');</script>
								<?php endif; ?>
								<!-- FIN DE GENERATEUR VIDEO -->

							</div>
						</div>
					</div>
				</div>
		</div>
		<hr>

		</div>

		<div class="row">
			<div class="form-group col-3">
				<input type="submit" class="btn btn-success col-12" value="Mise à jour du film">
			</div>
			<div class="col-3">
				<a href="<?php echo base_url();?>index.php?admin/movie_list" class="btn btn-secondary col-12">Retour</a>
			</div>
		</div>
	</div>
</form>
