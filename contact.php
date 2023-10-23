<?php
include 'partials/header.php';

?>



<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section" fw-bolder>CONTACT US</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-12">
					<div class="wrapper">
						<div class="row no-gutters">
							<div class="col-md-7 d-flex align-items-stretch">
								<div class="contact-wrap w-100 p-md-5 p-4">
									<h3 class="mb-4">Get in touch</h3>
									<div id="form-message-warning" class="mb-4"></div> 
				      		<div id="form-message-success" class="mb-4">
				            Your message was sent, thank you!
				      		</div>
									<form method="POST" id="contactForm" name="contactForm">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" name="name" id="name" placeholder="Name">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<input type="email" class="form-control" name="email" id="email" placeholder="Email">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<textarea name="message" class="form-control" id="message" cols="30" rows="7" placeholder="Message"></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
                                                    <div class="d-grid gap-2 col-6 mx-auto">
                                                        <button class="button-86" role="button">SEND</button>
                                                    </div>
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-lg-5 col-md-7 d-flex align-items-stretch">
								<div class="info-wrap w-100 p-lg-5 p-4 " style="background:hsl(51, 91%, 60%);">
									<h3 class="mb-4 mt-md-4">CONTACT US</h3>
				        	<div class="dbox w-100 d-flex align-items-start">
				        		<div class="icon d-flex align-items-center justify-content-center bg-dark ">
				        			<span class="fa fa-map-marker"></span>
				        		</div>
				        		<div class="text m-2 text-dark">
					            <p>Address: Rte manzel chaker,SFAX</p>
					          </div>
				          </div>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center bg-dark">
				        			<span class="fa fa-phone"></span>
				        		</div>
				        		<div class="text m-2 text-dark">
					            <p>Phone:+21655999066</p>
					          </div>
				          </div>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center bg-dark">
				        			<span class="fa fa-paper-plane"></span>
				        		</div>
				        		<div class="text m-2 text-dark">
					            <p>Email: mass1muscle@gmail.com</p>
					          </div>
				          </div>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center bg-dark">
				        			<span class="fa fa-globe"></span>
				        		</div>
				        		<div class="text m-2 text-dark">
					            <p>Website : massandmuscle.tn</p>
					          </div>
				          </div>
			          </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>




<?php
include 'partials/footer.php';

?>