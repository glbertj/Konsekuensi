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
    console.log(title);

    notificationMode(title, body, target);
}


let notificationCounter = localStorage.getItem('notificationCounter') || 0;
function scheduleNotification(notificationTitle, notificationBody, notificationTarget, dateId, notificationMode = generalNotification, timeDifference) {
    const title = document.getElementById(notificationTitle).value;
    const body = document.getElementById(notificationBody).value;
    const target = document.getElementById(notificationTarget).value;

    const dateTime = new Date(document.getElementById(dateId).value);
    console.log(dateTime);
    const taskTime = dateTime.getTime();
    const currentTime = new Date().getTime();
    const adjustedTime = taskTime - timeDifference * 60 * 1000;
    const adjustedTimeDifference = adjustedTime - currentTime;

    console.log('Time difference:', currentTime);
    console.log('Time difference:', taskTime);
    console.log('Adjusted Time:', adjustedTime);
    console.log('Time difference:', adjustedTimeDifference);
    console.log('Time difference in second:', adjustedTimeDifference / 1000);

    // Ganti logic di sini jadi pake worker / task scheduler
    if (adjustedTimeDifference > 0) {
        setTimeout(function () {
            try {
                notificationMode(title, body, target);
            } catch (error) {
                console.error('Error in notificationMode:', error);
            }
        }, adjustedTimeDifference);

        // Optional: You can use a unique identifier for each notification
        notificationCounter++;
        localStorage.setItem('notificationCounter', notificationCounter);
        console.log(notificationCounter);

        showSuccessAlert(dateTime, notificationCounter);
    } else {
        showFailAlert();
    }
    // ======================================================
}

// Rest of your code...



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

