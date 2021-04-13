function check_pass() {
   if (document.getElementById('create_mdp').value ==
      document.getElementById('confirm_mdp').value) {
      document.getElementById('message').style.color = 'rgb(128, 205, 79)';
      document.getElementById('message').innerHTML = '✔';
      document.getElementById('submit').disabled = false;

   } else {
      document.getElementById('message').style.color = 'rgb(210, 28, 28)';
      document.getElementById('message').innerHTML = '✗';
      document.getElementById('submit').disabled = true;

   }
}
