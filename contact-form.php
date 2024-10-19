<section class="section-full content-inner line-img section-title style-2" data-name="Contact">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 m-b30">
				<div class="dz-media-1 aos-item" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100">
					<img src="images/about/contact.webp" alt="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="section-head style-1">
					<h2 class="title">GET IN TOUCH <span class="text-primary"> WITH US</span></h2>
					<div class="dz-separator style-1 text-primary"></div>
				</div>

				<div class="progress-bx style-1 m-b40 aos-item" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
					<div class="progress-info">
						<form action="mailer/contact.php" class="dzContact" method="post">
							<div class="row">
								<!-- Name -->
								<div class="col-lg-6">
									<div class="form-group mb-3">
										<input type="text" name="name" required="" class="form-control" placeholder="Your Name">
									</div>
								</div>
								<!-- Email -->
								<div class="col-lg-6">
									<div class="form-group mb-3">
										<input type="email" name="email" required="" class="form-control" placeholder="Your Email Address">
									</div>
								</div>
								<!-- Phone -->
								<div class="col-lg-6">
									<div class="form-group mb-3">
										<input type="tel" name="phone" required="" class="form-control" placeholder="Your Phone Number">
									</div>
								</div>
								<!-- Looking for -->
								<div class="col-lg-6">
									<div class="form-group mb-3">
										<select name="looking_for" class="form-control" required="">
											<option value="">Looking for</option>
											<option value="plots">Plots</option>
											<option value="villas">Villas</option>
											<option value="commercial_spaces">Commercial Spaces</option>
											<option value="other">Other (Specify in Message)</option>
										</select>
									</div>
								</div>
								<!-- Construction Type -->
								<div class="col-lg-6">
									<div class="form-group mb-3">
										<select name="construction_type" class="form-control" required="">
											<option value="">Construction Type</option>
											<option value="new_home">New Home</option>
											<option value="renovation">Renovation</option>
											<option value="interiors">Interiors</option>
											<option value="carpentry">Carpentry</option>
											<option value="commercial">Commercial</option>
											<option value="other">Other (Specify in Message)</option>
										</select>
									</div>
								</div>
								<!-- Location of Project -->
								<div class="col-lg-6">
									<div class="form-group mb-3">
										<input type="text" name="project_location" required="" class="form-control" placeholder="Location of Project">
									</div>
								</div>
								<!-- Expected Start Date -->
								<div class="col-lg-6">
									<div class="form-group mb-3">
										<input type="text" name="start_date" class="form-control" placeholder="Expected Start Date">
									</div>
								</div>
								<!-- Budget for Construction -->
								<div class="col-lg-6">
									<div class="form-group mb-3">
										<input type="text" name="budget" class="form-control" placeholder="Budget for Construction">
									</div>
								</div>
								<!-- Do you already have an architect/designer? -->
								<div class="col-lg-12">
									<div class="form-group mb-3">
										<label class="d-block">Do you already have an architect/designer?</label>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="have_architect" id="have_architect_yes" value="yes">
											<label class="form-check-label" for="have_architect_yes">Yes</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="have_architect" id="have_architect_no" value="no">
											<label class="form-check-label" for="have_architect_no">No</label>
										</div>
									</div>
								</div>
								<!-- If yes, who is the architect/designer -->
								<div class="col-lg-12">
									<div class="form-group mb-3">
										<input type="text" name="architect_name" class="form-control" placeholder="If yes, who is the architect/designer?">
									</div>
								</div>
								<!-- How did you hear about us? -->
								<!-- <div class="col-lg-12">
									<div class="form-group mb-3">
										<input type="text" name="referral_source" class="form-control" placeholder="How did you hear about us?">
									</div>
								</div> -->
								<!-- If you were referred, through whom? -->
								<!-- <div class="col-lg-12">
									<div class="form-group mb-3">
										<input type="text" name="referred_by" class="form-control" placeholder="If you were referred, through whom?">
									</div>
								</div> -->
								<!-- Message -->
								<div class="col-lg-12">
									<div class="form-group mb-3">
										<textarea name="message" class="h-auto form-control" placeholder="Message" rows="4"></textarea>
									</div>
								</div>
								<!-- Submit Button -->
								<div class="col-lg-12 text-center">
									<button name="submit" type="submit" value="Submit" class="btn btn-primary">Submit Enquiry</button>
								</div>
							</div>
						</form>


					</div>


				</div>

			</div>
		</div>
	</div>
</section>