
<?php
//An api is called where the current weather of the place where the user will start his voyage, is returned
function getWeather($location)
{
  $response = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=' . urlencode($location) . ',ch&APPID=3a95d22b951e96c55466e350c346af5c');
  $response = json_decode($response, true);
  // because not everything of the response is used only some attributes are sorted out and saved to the $weather variable.
  $weather = [$response['weather'][0]['description'], $response['main']['temp'] - 272];
  return $weather;
}
?>
