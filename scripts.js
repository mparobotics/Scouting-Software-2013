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



function core() {
    this.showId = function(id) {
        document.getElementById(id).style.display = "block";
    };
    
    this.hideId = function(id) {
        document.getElementById(id).style.display = "none";
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