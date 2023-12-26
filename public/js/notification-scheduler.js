// This file handles timed notifications


// dateId -> id for the 'datetime-local' input
// title -> notification title
// body -> notification body
// target -> "https://example.com" -> when empty, this will open a blank page when clicked
function scheduleTask(dateId, taskTitle, taskBody, taskTarget) {
    const dateTime = new Date(document.getElementById(dateId).value);
    const taskTime = dateTime.getTime();
    const currentTime = new Date().getTime();
    const timeDifference = taskTime - currentTime;

    const title = document.getElementById(taskTitle).value;
    const body = document.getElementById(taskBody).value;
    const target = document.getElementById(taskTarget).value;

    // Ganti logic di sini jadi pake worker / task scheduler
    if (timeDifference > 0) {
        setTimeout(function () {
            showGeneralNotification(title, body, target);
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


function showGeneralNotification(title, body, target) {
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

