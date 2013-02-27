//JavaScript Document

/*
Correct Class Definition:


function Apple (type) {
    this.type = type;
    this.color = "red";
    this.getInfo = function() {
        return this.color + ' ' + this.type + ' apple';
    };
}

*/

function delay(command, time) {
    setTimeout(command, time);
}

function sync() {
    this.check = function(id) {
        var xmlhttp;
        var output = "";
        xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                if(xmlhttp.responseText == "alive") {
                    Sync.sync(false);
                }
            }
          }
        xmlhttp.open("GET","/server.php?query=alive&device="+Data.id,true);
        xmlhttp.send();
        Sync.resetTimer();
    };
    
    this.resetTimer = function(id) {
        delay('Sync.check();',10000);
    };
    
    this.sync = function(push) {
        console.log("Sync started!");
        View.pushView(5);
        if (push) {
            var xmlhttp;
            var output = "";
            xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function()
              {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    console.log(xmlhttp.responseText);
                    localStorage.setItem('teamData', '');
                    Data.teamData = "";
                }
              }
            xmlhttp.open("GET","/server.php?query=data&data="+Data.teamData,true);
            xmlhttp.send();
            Sync.resetTimer();
        }
    };
}

var Sync = new sync;

function data() {
    
    this.id = localStorage.getItem('deviceId');
    this.lastSync = localStorage.getItem('lastSync');
    this.teamData = localStorage.getItem('teamData');
    this.matchData = localStorage.getItem('matchData');
    this.team1 = "";
    this.team2 = "";
    this.team3 = "";
    this.matchNumber = 0;
    this.teamData = localStorage.getItem('teamData');
    //Team Number, Match Number, Thoughts, Shooting, Lifting, Assisting, Penalties, Comments
    this.currentTeamData = new Array([0,0,0,0,0,0,"N/A","N/A"], [0,0,0,0,0,0,"N/A","N/A"], [0,0,0,0,0,0,"N/A","N/A"]);
    
    this.checkDeviceId = function() {
        if (Data.id > 0) {
            View.pushView(2);
        } else {
            View.pushView(1);
        }
    };
    
    this.setDeviceId = function() {
        localStorage.setItem('deviceId', document.getElementById('deviceNumber').value);
        Data.id = localStorage.getItem('deviceId');
        View.pushView(2);
        return true;
    };
    
    this.setTeams = function() {
        Data.team1 = document.getElementById('team1').value;
        Data.team2 = document.getElementById('team2').value;
        Data.team3 = document.getElementById('team3').value;
        Data.matchNumber = document.getElementById('matchNumber').value;
        document.getElementById('teamStat1Label').innerHTML = "Team: "+Data.team1;
        document.getElementById('teamStat2Label').innerHTML = "Team: "+Data.team2;
        document.getElementById('teamStat3Label').innerHTML = "Team: "+Data.team3;
        document.getElementById('teamMatchLabel').innerHTML = "Match: "+Data.matchNumber;
        View.pushView(3);
        return true;
    };
    
    this.createData = function() {
        Data.currentTeamData[0][0] = Data.team1;
        Data.currentTeamData[1][0] = Data.team2;
        Data.currentTeamData[2][0] = Data.team3;
        Data.currentTeamData[0][1] = Data.matchNumber;
        Data.currentTeamData[1][1] = Data.matchNumber;
        Data.currentTeamData[2][1] = Data.matchNumber;
        Data.currentTeamData[0][2] = document.getElementById('scoreDetailObject11').value;
        Data.currentTeamData[1][2] = document.getElementById('scoreDetailObject21').value;
        Data.currentTeamData[2][2] = document.getElementById('scoreDetailObject31').value;
        Data.currentTeamData[0][3] = document.getElementById('scoreDetailObject12').value;
        Data.currentTeamData[1][3] = document.getElementById('scoreDetailObject22').value;
        Data.currentTeamData[2][3] = document.getElementById('scoreDetailObject32').value;
        Data.currentTeamData[0][4] = document.getElementById('scoreDetailObject13').value;
        Data.currentTeamData[1][4] = document.getElementById('scoreDetailObject23').value;
        Data.currentTeamData[2][4] = document.getElementById('scoreDetailObject33').value;
        Data.currentTeamData[0][5] = document.getElementById('scoreDetailObject14').value;
        Data.currentTeamData[1][5] = document.getElementById('scoreDetailObject24').value;
        Data.currentTeamData[2][5] = document.getElementById('scoreDetailObject34').value;
        Data.currentTeamData[0][6] = document.getElementById('scoreDetailObject15').value;
        Data.currentTeamData[1][6] = document.getElementById('scoreDetailObject25').value;
        Data.currentTeamData[2][6] = document.getElementById('scoreDetailObject35').value;
        Data.currentTeamData[0][7] = document.getElementById('scoreDetailObject16').value;
        Data.currentTeamData[1][7] = document.getElementById('scoreDetailObject26').value;
        Data.currentTeamData[2][7] = document.getElementById('scoreDetailObject36').value;
    };
        
    this.saveData = function() {
        
        if (Data.teamData == null) {
            Data.teamData = Data.currentTeamData.join('_');
        } else {
            Data.teamData = Data.teamData+"_"+Data.currentTeamData.join('_');
        }
        
        localStorage.setItem("teamData", Data.teamData);
    };
    
    this.reset = function() {
        scoutForm.reset();
        scoutForm2.reset();
        scoutForm3.reset();
        scoutForm4.reset();
        scoutForm5.reset();
        Data.checkDeviceId();
    }
}

var Data = new data;

function core() {
    this.showId = function(id) {
        document.getElementById(id).style.display = "block";
    };
    
    this.hideId = function(id) {
        document.getElementById(id).style.display = "none";
    };
    
    this.load = function() {
        //Fill device id
        Data.checkDeviceId();
        //Launch sync
        Sync.check();
    };
}

var Core = new core;

function view() {
    this.pushView = function(view) {
        switch(view) {
                case 1:
                Core.showId('view1');
                Core.hideId('view2');
                Core.hideId('view3');
                Core.hideId('view4');
                Core.hideId('view5');           
                break;
                case 2:
                Core.hideId('view1');
                Core.showId('view2');
                Core.hideId('view3');
                Core.hideId('view4');
                Core.hideId('view5');           
                break;
                case 3:
                Core.hideId('view1');
                Core.hideId('view2');
                Core.showId('view3');
                Core.hideId('view4');
                Core.hideId('view5');           
                break;
                case 4:
                Core.hideId('view1');
                Core.hideId('view2');
                Core.hideId('view3');
                Core.showId('view4');
                Core.hideId('view5');           
                break;
                case 5:
                Core.hideId('view1');
                Core.hideId('view2');
                Core.hideId('view3');
                Core.hideId('view4');
                Core.showId('view5');           
                break;
                case 6:
                Core.showId('eventDetails');
                Core.hideId('teamScout');
                Core.hideId('matchScout');
                Core.hideId('stat');
                Core.hideId('trends');  
                Core.hideId('leaderboards');  
                break;
                case 7:
                Core.hideId('eventDetails');
                Core.showId('teamScout');
                Core.hideId('matchScout');
                Core.hideId('stat');
                Core.hideId('trends');  
                Core.hideId('leaderboards');  
                break;
                case 8:
                Core.hideId('eventDetails');
                Core.hideId('teamScout');
                Core.showId('matchScout');
                Core.hideId('stat');
                Core.hideId('trends');  
                Core.hideId('leaderboards');  
                break;
                case 9:
                Core.hideId('eventDetails');
                Core.hideId('teamScout');
                Core.hideId('matchScout');
                Core.showId('stat');
                Core.hideId('trends');  
                Core.hideId('leaderboards');  
                break;
                case 10:
                Core.hideId('eventDetails');
                Core.hideId('teamScout');
                Core.hideId('matchScout');
                Core.hideId('stat');
                Core.showId('trends');  
                Core.hideId('leaderboards');  
                break;
                case 11:
                Core.hideId('eventDetails');
                Core.hideId('teamScout');
                Core.hideId('matchScout');
                Core.hideId('stat');
                Core.hideId('trends');  
                Core.showId('leaderboards');  
                break;
        }
    };
                
    this.openDetail = function(group, module) {
        Core.showId('scoreDetailObject'+group+module);
                
    };
                
    this.closeDetail = function(group, module) {
        Core.hideId('scoreDetailObject'+group+module);
    };
}
var View = new view;
                
function scoreDetail() {
    this.checkDetail = function(group, module) {
        if (document.getElementById('scoreDetailBox'+group+module).checked) {
            View.openDetail(group, module);
        } else {
            View.closeDetail(group, module);
        }
    };
}
var ScoreDetail = new scoreDetail;