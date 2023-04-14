<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Informationen aus dem Kontaktformular erhalten
  $discordtag = $_POST["discordtag"];
  $name = $_POST["name"];
  $email = $_POST["email"];
  $titel = $_POST["titel"];
  $message = $_POST["message"];

  // Discord Webhook-URL des Zielchannels
  $webhookurl = "https://discord.com/api/webhooks/1091366205408940062/X4p2AXsbJaXPoB--xfCpFCnLVF-ggpeMWPQQ_Hg_H3oXQz3vrH9p2VylJAjoO2trlVRy";

  // JSON-Payload vorbereiten
  $payload = json_encode(array(
    "content" => "Neue Anfrage @Admins:\n\nDiscord Tag: $discordtag\nName: $name\nE-Mail: $email\n Titel: $titel\nNachricht: $message"
  ));

  // cURL verwenden, um den Webhook zu senden
  $ch = curl_init($webhookurl);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
  ]);
  $result = curl_exec($ch);
  curl_close($ch);

  // Erfolgsmeldung ausgeben oder Fehlermeldung, falls etwas schiefgegangen ist
  if ($result === false) {
    echo "Beim erfassen der Bestellung ist ein Fehler aufgetreten.";
  } else {
    echo "Die Bestellung wurde erfolgreich gesendet.";
  }
}
?>
