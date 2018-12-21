<?php
	echo '<div id="wrapper">';
		echo '<div id="page-wrapper">';
			echo '<div class="container-fluid">';
				#<!-- Page Heading -->
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						echo '<h1 class="page-header">Forms</h1>';
						echo '<ol class="breadcrumb">';
							echo '<li><i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a></li>';
							echo '<li class="active"><i class="fa fa-edit"></i> Forms</li>';
						echo '</ol>';
					echo '</div>';
				echo '</div>';
				#<!-- /.row -->
				echo '<div class="row">';
					echo '<div class="col-lg-6">';
						echo '<form role="form">';
							echo '<fieldset class="form-group">';
								echo '<label>Text Input</label>';
								echo '<input class="form-control">';
								echo '<p class="help-block">Example block-level help text here.</p>';
							echo '</fieldset>';

							echo '<fieldset class="form-group">';
								echo '<label>Text Input with Placeholder</label>';
								echo '<input class="form-control" placeholder="Enter text">';
							echo '</fieldset>';

							echo '<div class="form-group">';
								echo '<label>Static Control</label>';
								echo '<p class="form-control-static">email@example.com</p>';
							echo '</div>';

							echo '<fieldset class="form-group">';
								echo '<label for="exampleInputFile">File input</label>';
								echo '<input type="file" class="form-control-file" id="exampleInputFile">';
							echo '</fieldset>';

							echo '<fieldset class="form-group">';
								echo '<label>Text area</label>';
								echo '<textarea class="form-control" rows="3"></textarea>';
							echo '</fieldset>';

							echo '<div class="form-group">';
								echo '<label>Checkboxes</label>';
								echo '<div class="checkbox">';
									echo '<label><input type="checkbox" value=""> Checkbox 1</label>';
								echo '</div>';
								echo '<div class="checkbox">';
									echo '<label><input type="checkbox" value=""> Checkbox 2';
								echo '</div>';
								echo '<div class="checkbox">';
									echo '<label><input type="checkbox" value=""> Checkbox 3</label>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group">';
								echo '<label>Inline Checkboxes</label>';
								echo '<label class="checkbox-inline"><input type="checkbox">1</label>';
								echo '<label class="checkbox-inline"><input type="checkbox">2</label>';
								echo '<label class="checkbox-inline"><input type="checkbox">3</label>';
							echo '</div>';

							echo '<fieldset class="form-group">';
								echo '<label>Radio Buttons</label>';
								echo '<div class="radio">';
									echo '<label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked> Radio 1</label>';
								echo '</div>';
								echo '<div class="radio">';
									echo '<label><input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Radio 2</label>';
								echo '</div>';
								echo '<div class="radio">';
									echo '<label><input type="radio" name="optionsRadios" id="optionsRadios3" value="option3"> Radio 3</label>';
								echo '</div>';
							echo '</fieldset>';

							echo '<fieldset class="form-group">';
								echo '<label>Inline Radio Buttons</label>';
								echo '<label class="radio-inline"><input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="option1" checked>1</label>';
								echo '<label class="radio-inline"><input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="option2">2</label>';
								echo '<label class="radio-inline"><input type="radio" name="optionsRadiosInline" id="optionsRadiosInline3" value="option3">3</label>';
							echo '</fieldset>';

							echo '<div class="form-group">';
								echo '<label>Selects</label>';
								echo '<select class="form-control">';
									echo '<option>1</option>';
									echo '<option>2</option>';
									echo '<option>3</option>';
									echo '<option>4</option>';
									echo '<option>5</option>';
								echo '</select>';
							echo '</div>';

							echo '<fieldset class="form-group">';
								echo '<label>Multiple Selects</label>';
								echo '<select multiple class="form-control">';
									echo '<option>1</option>';
									echo '<option>2</option>';
									echo '<option>3</option>';
									echo '<option>4</option>';
									echo '<option>5</option>';
								echo '</select>';
							echo '</fieldset>';

							echo '<button type="submit" class="btn btn-secondary">Submit Button</button>';
							echo '<button type="reset" class="btn btn-secondary">Reset Button</button>';
						echo '</form>';
					echo '</div>';
					echo '<div class="col-lg-6">';
						echo '<h1>Disabled Form States</h1>';
						echo '<form role="form">';
							echo '<fieldset disabled>';
								echo '<div class="form-group">';
									echo '<label for="disabledSelect">Disabled input</label>';
									echo '<input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled>';
								echo '</div>';

								echo '<div class="form-group">';
									echo '<label for="disabledSelect">Disabled select menu</label>';
									echo '<select id="disabledSelect" class="form-control">';
										echo '<option>Disabled select</option>';
									echo '</select>';
								echo '</div>';

								echo '<div class="checkbox">';
									echo '<label><input type="checkbox"> Disabled Checkbox</label>';
								echo '</div>';

								echo '<button type="submit" class="btn btn-primary">Disabled Button</button>';
							echo '</fieldset>';
						echo '</form>';
						echo '<br />';

						echo '<h1>Form Validation</h1>';
						echo '<form role="form">';
							echo '<div class="form-group has-success">';
								echo '<label class="form-control-label" for="inputSuccess">Input with success</label>';
								echo '<input type="text" class="form-control form-control-success" id="inputSuccess">';
							echo '</div>';

							echo '<div class="form-group has-warning">';
								echo '<label class="form-control-label" for="inputWarning">Input with warning</label>';
								echo '<input type="text" class="form-control form-control-warning" id="inputWarning">';
							echo '</div>';

							echo '<div class="form-group has-danger">';
								echo '<label class="form-control-label" for="inputError">Input with danger</label>';
								echo '<input type="text" class="form-control form-control-danger" id="inputError">';
							echo '</div>';
						echo '</form>';

						echo '<h1>Input Groups</h1>';
						echo '<form role="form">';
							echo '<div class="form-group input-group">';
								echo '<span class="input-group-addon">@</span>';
								echo '<input type="text" class="form-control" placeholder="Username">';
							echo '</div>';

							echo '<div class="form-group input-group">';
								echo '<input type="text" class="form-control">';
								echo '<span class="input-group-addon">.00</span>';
							echo '</div>';

							echo '<div class="form-group input-group">';
								echo '<span class="input-group-addon"><i class="fa fa-eur"></i></span>';
								echo '<input type="text" class="form-control" placeholder="Font Awesome Icon">';
							echo '</div>';

							echo '<div class="form-group input-group">';
								echo '<span class="input-group-addon">$</span>';
								echo '<input type="text" class="form-control">';
								echo '<span class="input-group-addon">.00</span>';
							echo '</div>';

							echo '<div class="form-group input-group">';
								echo '<input type="text" class="form-control">';
								echo '<span class="input-group-btn"><button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button></span>';
							echo '</div>';
						echo '</form>';

						echo '<p>For complete documentation, please visit <a target="_blank" href="http://v4-alpha.getbootstrap.com/components/forms/">Bootstrap\'s Form Documentation</a>.</p>';
					echo '</div>';
				echo '</div>';
				#<!-- /.row -->
			echo '</div>';
			#<!-- /.container-fluid -->
		echo '</div>';
		#<!-- /#page-wrapper -->
	echo '</div>';