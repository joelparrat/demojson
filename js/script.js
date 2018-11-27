
$(
	$(function()
	{
		$('.connexion').click
		(
			function()
			{
				if (($('[name="lgn"]').val() != "") && (($('[name="pwd"]').val() != "")))
				{
					let objJSON =
					{
						lgn: $('[name="lgn"]').val(),
						pwd: $('[name="pwd"]').val()
					};
					//console.log(JSON.stringify(objJSON));
					
					$.post
					(
						"../php/cnn_fonction.php",
						JSON.stringify(objJSON), 
						function(data)
						{
							let msg = $.parseJSON(data);
							if (!msg.ret)
							{
								$('[name="lgn"]').css("color", "black");
								$('[name="pwd"]').css("color", "black");
								$('.message').css("color", "green");
								$('.message').html(msg.mss);
								$(location).attr('href',"gstflm.html");
							}
							else if (msg.ret == 1)
							{
								$('[name="lgn"]').css("color", "darkblue");
								$('[name="pwd"]').css("color", "darkblue");
								$('.message').css("color", "darkblue");
								$('.message').html(msg.mss);
								$(location).attr('href',"gstflm.html");
							}
							else
							{
								$('[name="lgn"]').css("color", "red");
								$('[name="pwd"]').css("color", "red");
								$('.message').css("color", "darkblue");
								$('.message').html(msg.mss);
							}
						}
					);

				}
				else
				{
					if (($('[name="lgn"]').val() == "") && ($('[name="pwd"]').val() == ""))
					{
						$('.message').css("color", "red");
						$('.message').html("Veuillez vous identifier ...");
					}
					else if ($('[name="lgn"]').val() == "")
					{
						$('.message').css("color", "red");
						$('.message').html("Entrez votre identifiant ...");
					}
					else
					{
						$('.message').css("color", "red");
						$('.message').html("Entrez votre mot de passe ...");
					}
				}
			}
		) 
	})
);

