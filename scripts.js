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
        xmlhttp.open("GET","/server.php?query=alive",true);
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
        }
    };
}

var Sync = new sync;

function data() {
    
    this.id = localStorage.getItem('deviceId');
    this.lastSync = localStorage.getItem('lastSync');
    this.teamData = localStorage.getItem('teamData');
    this.matchData = localStorage.getItem('matchData');
    
    this.checkDeviceId = function() {
        if (Data.id > 0) {
            View.pushView(2);
        } else {
            return false;
        }
    };
    
    this.setDeviceId = function() {
        localStorage.setItem('deviceId', document.getElementById('deviceNumber').value);
        Data.id = localStorage.getItem('deviceId');
        View.pushView(2);
        return true;
    };
    
    this.load = function() {
        //Fill device id
        //Launch sync
        Sync.check();
    };
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