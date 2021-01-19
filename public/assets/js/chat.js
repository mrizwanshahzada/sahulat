
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('c1956e4edade858e0630', {
    cluster: 'ap2'
});

var channel = pusher.subscribe('user');
channel.bind('MessageEvents', function(data) {
    alert('working')
    console.log(data);
});
