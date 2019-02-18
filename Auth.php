<?php
class Auth
{
	private $appid = "6035340";
	private $redirect_uri;
	private $scope = "friends,video,audio,groups,status,wall";
	private $main_link;

	//Защищённый ключ VY6Z91Apzr1MrPz0dkNg
	//Сервисный ключ доступа 7f5a8ebd7f5a8ebd7f5a8ebdfe7f06993177f5a7f5a8ebd26416277a280fc67b7862048

	function __construct($main_link)
    {
        $this->main_link = $main_link;
        $this->redirect_uri = $main_link."/login.php";
     //   $this->redirect_uri = "https://oauth.vk.com/blank.html";
		//$this->appid = $appid;
		//$this->redirect_uri = $redirect_uri;
		//$this->scope = $scope;
	}
	
	public function VK($page = null)
	{
		if ($page){
		//    echo "<h1>TEST</h1>";
			echo "<script>
					window.location.href = \"https://oauth.vk.com/authorize?client_id=".$this->appid."&display=popup&redirect_uri=".$this->redirect_uri."?page=$page&scope=".$this->scope."&response_type=token&v=5.92&state=123456\"
				</script>";}
		else
			echo "<script>
					window.location.href = \"https://oauth.vk.com/authorize?client_id=".$this->appid."&display=popup&redirect_uri=".$this->redirect_uri."&scope=".$this->scope."&response_type=token&v=5.92&state=123456\"
				</script>";			
	}

	public function VKI(){
        echo "<script>
					window.open( \"https://oauth.vk.com/authorize?client_id=".$this->appid."&display=popup&redirect_uri=https://oauth.vk.com/blank.html&response_type=token&scope=".$this->scope."&v=5.92&state=123456\")
				</script>";
    }
}
?>