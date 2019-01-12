<!-- content sarea starts-->
		
<div id="content">
			<div>
				<img src="images/map.png" alt="kuch bhi" style="float: left; margin-left: -40px; width:575px;" />
			</div>
			<div id="form2">
				<form action="" method="post">
					<h2>Sign Up Here</h2>
					<table>
						<tr>
							<td align="right">Name: </td>
							<td><input type="text" name="u_name" placeholder="Enter Your name" required="required"></td>
						</tr>
						<tr>
							<td align="right">Password: </td>
							<td><input type="password" name="u_pass" placeholder="Enter Your password" required="required"></td>
						</tr>
						<tr>
							<td align="right">Email: </td>
							<td><input type="email" name="u_email" placeholder="Enter Your Email" required="required"></td>
						</tr>
						<tr>
							<td align="right">Country: </td>
							<td>
								<select name="u_country">
									<option>Select a Country</option>
									<option>India</option>
									<option>USA</option>
									<option>Japan</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align="right">Gender: </td>
							<td><select name="u_gender">
									<option>Select your gender</option>
									<option>Male</option>
									<option>Female</option>
									<option>Other</option>
								</select></td>
						</tr>
						<tr>
							<td align="right">DoB: </td>
							<td><input type="date" name="u_birthday"></td>
						</tr>
						<tr>
							<td colspan="6">
								<button name="sign_up">Sign Up</button>
							</td>
						</tr>
					</table>
				</form>
				<?php 
include('user_insert.php');
?>
			</div>
		</div>
