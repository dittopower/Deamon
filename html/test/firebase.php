<head>
<script src="https://code.jquery.com/jquery-3.0.0.min.js" type="text/javascript"></script>
<script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBuJNvcscqzbIJ2mc_ZV3_IkNQULJJVIYw",
    authDomain: "dndeamon.firebaseapp.com",
    databaseURL: "https://dndeamon.firebaseio.com",
    storageBucket: "dndeamon.appspot.com",
  };
  firebase.initializeApp(config);
var database = firebase.database();


//window.onload = function(){
firebase.database().ref('/Race').once('value').then(function(snapshot) {
  Races = snapshot.val();
  var bd = $('body');
  for(var i in Races){
    console.log(i);
    bd.append("<div>"+i+"</div>");
    bd.append("<span>"+Races[i].stats+"</span>");
  }
});
//}
</script>
</head>