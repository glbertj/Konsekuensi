// This file handles notifications

// notificationTitle -> the title you want your notification to have
// notificationBody -> body.
// notificationMode -> scroll down for notification mode list, default is generalNotification
// target -> "https://example.com" -> when empty, this will open a blank page when clicked

// example of general notification call: callNotification(id_of_title_input, id_of_body_input, id_of_target_input);
// Just add an extra parameter of datetime input id to use the scheduler instead (polymorphism baby)

// if you want to hardcode the notificatioon, use the notification mode directly.
// ex: callNotification('hi im title', 'hi this is the body', 'wwww.youtube.com');


function callNotification(notificationTitle, notificationBody, notificationTarget, notificationMode = generalNotification) {
    const title = document.getElementById(notificationTitle).value;
    const body = document.getElementById(notificationBody).value;
    const target = document.getElementById(notificationTarget).value;

    notificationMode(title, body, target);
}


<<<<<<< HEAD
function scheduleNotification(notificationTitle, notificationBody, notificationTarget, dateId, notificationMode = generalNotification) {
=======
function callNotification(notificationTitle, notificationBody, notificationTarget, dateId, notificationMode = generalNotification) {
>>>>>>> c8af0f18b041b1a08bf1bd25cc69bf535d709f7f
    const title = document.getElementById(notificationTitle).value;
    const body = document.getElementById(notificationBody).value;
    const target = document.getElementById(notificationTarget).value;
    
    const dateTime = new Date(document.getElementById(dateId).value);
    const taskTime = dateTime.getTime();
    const currentTime = new Date().getTime();
    const timeDifference = taskTime - currentTime;

    // Ganti logic di sini jadi pake worker / task scheduler
    if (timeDifference > 0) {
        setTimeout(function () {
            notificationMode(title, body, target);
        }, timeDifference);
        showSuccessAlert(dateTime);
    } else {
        showFailAlert();
    }
    // ======================================================
}


function showSuccessAlert(dateTime) {
    alert(`Task scheduled at: ${dateTime}`);
}

function showFailAlert() {
    alert('Scheduling failed');
}


// Notification modes:
function generalNotification(title, body, target) {
    if ('Notification' in window) {
        Notification.requestPermission().then(function (permission) {
            if (permission === 'granted') {
                Push.create(title, {
                    body: body,
                    icon: '',
                    timeout: 4000,
                    onClick: function () {
                        window.open(target);
                        this.close();
                    }
                });
            }
        });
    }
}



// You can add custom notifications down, just follow the template from showGeneralNotification
function customNotification() {

}

function customNotification() {
    
}

function customNotification() {
    
}