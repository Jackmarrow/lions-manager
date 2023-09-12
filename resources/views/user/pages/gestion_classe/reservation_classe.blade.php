<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>



<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="p-4">
            <div class="container">
                {{-- classe is a variable we get from the url of the page --}}
                <h1 class="text-center py-3">Classe : <span class="text-primary">{{ $classe->name }}</span> </h1>
                {{-- classes is our table  --}}
                <div class="d-flex justify-content-center">
                    @foreach ($classes as $classex)
                        @if ($classe->name == $classex->name)
                            <a class="nav-link" href={{ route('userCalendar.showcal', $classex->id) }}> <button
                                    class="btn btn-primary">{{ $classex->name }}</button> </a>
                        @else
                            <a class="nav-link" href={{ route('userCalendar.showcal', $classex->id) }}> <button
                                    class="btn btn-light">{{ $classex->name }}</button> </a>
                        @endif
                    @endforeach
                </div>
                <hr>
                <div id='calendar'></div>
            </div>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";
            // pass data from the server-side PHP code to the client-side JavaScript code
            var resv_classes = @json($myevents);
            //the element we got from the url of the page => we will get from it the id of the classe and its name
            var classe = @json($classe);
            // conected user to the session
            var connectedUser = @json($userName);

            // console.log(connectedUser);
            // Find the date of the last event in your events array
            var lastEventDate = moment(); // Initialize with the current date as a fallback
            if (resv_classes.length > 0) {
                lastEventDate = moment(resv_classes[resv_classes.length - 1].start);
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                header: { //An object that defines the navigation buttons and titles for the calendar's header.
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay' // Include listWeek view
                },
                views: {
                    agendaDay: {
                        minTime: '07:00:00', // Start time (8:00 AM)
                        maxTime: '19:00:00' // End time (6:00 PM)
                    },
                    agendaWeek: {
                        minTime: '07:00:00', // Start time (8:00 AM)
                        maxTime: '19:00:00' // End time (6:00 PM)
                    }
                },
                defaultView: 'agendaWeek', // Default view when the calendar loads
                defaultDate: lastEventDate, // Set the default date to the date of last event has been added 
                editable: false, // Determines if events can be dragged and resized.
                events: resv_classes, //our table after passing it from Laravel backend to our frontend JavaScript code
                displayEventTime: true,

                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                // to Style the days
                dayRender: function(date, cell) {
                    var today = moment(); // Get the current date
                    if (date.isSame(today, 'day')) {
                        // If the date is the current day, change the cell's background color
                        cell.css('background-color', '#B9F6FD'); // The background color of taday
                    }
                    if (date.isBefore(today, 'day')) {
                        // If the date is in the past, change the cell's background color
                        cell.css('background-color',
                            '#EDEDE6'); // 'gray' 
                    }
                },
                // to Style the events (the one i wanna cancel or the past events)
                eventRender: function(event, element, view) {
                    // Check if the event is in the past
                    var currentDate = moment().startOf('day'); // Get the current date
                    var currentDateTime = moment(); // Get the current date and time
                    if (moment(event.start).isBefore(currentDate) || moment(event.end).isBefore(
                            currentDateTime)) { //verify if the event is in a past day or time
                        // Apply a different style to past events
                        element.css('background-color', 'gray');
                        element.css('border-color', 'gray');
                    } else if (event.user_name == connectedUser) { // == name of user currently connected
                        // Apply a different style to events added by the same user
                        element.css('background-color', 'green');
                        element.css('border-color', 'green');
                    } else {
                        // change the color of the clicked event to red (click to cancel reservation)
                        element.on('click', function() {
                            if (calendar.fullCalendar('getView').name !== 'month') {
                                if (element.data('selected') || event.user_name !=
                                connectedUser) { // != name of user currently connected
                                    // If already selected, unselect it
                                    element.data('selected', false);
                                    element.css('background-color', event
                                        .backgroundColor
                                    ); // Reset to the original background color
                                } else { //this else stopped working at some moment idk why :)
                                    // If not selected, select it and change the background color
                                    element.data('selected', true);
                                    element.css('background-color',
                                        'red'); // Change to desired background color
                                }

                            }
                        });
                    }
                    //get the user name who added the event
                    var eventInfo = ' (' + event.start.format('h:mm a') + ' - ' + event
                        .end.format('h:mm a') + ') / ' + event.title;
                    if (event.user_name) {
                        eventInfo += ' booked by ' + event.user_name.toUpperCase();
                    }
                    element.find('.fc-title').html(eventInfo);
                },

                select: function(start, end) {
                    console.log(event.user_name);
                    if (calendar.fullCalendar('getView').name !== 'month') {

                        var currentDate = moment().startOf('day'); // Get the current date
                        var currentDateTime = moment(); // Get the current date and time
                        //verify => You cannot add Reservation to past days or time slots
                        if (start.isBefore(currentDate)) {
                            alert("You cannot add Reservation to past days.");
                            calendar.fullCalendar('unselect');
                            return;
                        } else if (end.isBefore(currentDateTime) || start.isBefore(
                                currentDateTime)) { //test tomorrow
                            alert("You cannot add Reservation to past Time slots.");
                            calendar.fullCalendar('unselect');
                            return;
                        }
                        //fill these variables from the element we got from the url
                        var title = classe.id;
                        var titletext = classe.name;
                        if (title) {
                            var start = start.format("Y-MM-DD HH:mm:ss");
                            var end = end.format("Y-MM-DD HH:mm:ss");
                            var canAddEvent = true; // Initialize as true
                            // Iterate through existing events to check for conflicts
                            resv_classes.forEach(element => {
                                if (element.resv_etat ==
                                    1) { // Only check conflicts with reserved events
                                    // Check if the selected time slot overlaps with the time slot of the element
                                    var eventStart = moment(start);
                                    var eventEnd = moment(end);
                                    var existingStart = moment(element.start);
                                    var existingEnd = moment(element.end);
                                    if (
                                        (eventStart >= existingStart && eventStart <
                                            existingEnd) ||
                                        (eventEnd > existingStart && eventEnd <= existingEnd) ||
                                        (eventStart < existingStart && eventEnd > existingStart)
                                    ) {
                                        canAddEvent =
                                            false; // Conflicting event found, cannot add
                                    }
                                }
                            });
                            // the whole interactions works only after refreshing the page ! (something between ajax & laravel)
                            if (canAddEvent) {
                                $.ajax({
                                    url: SITEURL + "/fullcalenderAjax",
                                    data: {
                                        title: title,
                                        start: start,
                                        end: end,
                                        type: 'add'
                                    },
                                    type: "POST",
                                    success: function(data) {
                                        displayMessage(
                                            "Reservation Created Successfully");
                                        calendar.fullCalendar('renderEvent', {
                                            id: data.id,
                                            title: titletext,
                                            start: start,
                                            end: end,
                                            allDay: false
                                        }, true);
                                        calendar.fullCalendar('unselect');
                                    },
                                    //dumb solution but working ^^"
                                    success: function(response) {
                                        // Dghanich Magic
                                        location.reload();
                                    },
                                });
                            } else {
                                alert("Classe Already reserved at this Time");
                                calendar.fullCalendar('unselect');
                            }
                        }
                    }
                },
                // click on an event to cancel its Reservation
                eventClick: function(event) {
                    var currentDate = moment().startOf('day'); // Get the current date
                    if (moment(event.start).isBefore(currentDate)) {
                        alert("You cannot interact with past events.");
                        return false; // Prevents the user from clicking or interacting with past events
                    } else if (calendar.fullCalendar('getView').name == 'month') {
                        return false; // Prevents the user from clicking or interacting with events if the calendar is in month view
                    } else if (event.user_name !=
                    connectedUser) { // != different than the name of the user currently connected 
                        alert("this reservation Ain't yours .. you CAN NOT Cancel it");
                    } else {
                        setTimeout(() => {
                            var deleteMsg = confirm(
                                "Do you really want to cancel this reservation?");
                            if (deleteMsg) {
                                $.ajax({
                                    type: "POST",
                                    url: SITEURL + '/fullcalenderAjax',
                                    data: {
                                        id: event.id,
                                        type: 'delete'
                                    },
                                    success: function(response) {
                                        calendar.fullCalendar('removeEvents',
                                            event.id);
                                        displayMessage(
                                            "Reservation Canceled Successfully"
                                        );
                                    },
                                    //dumb solution but working ^^"
                                    success: function(response) {
                                        // Dghanich Magic
                                        location.reload();
                                        lastEventDate = moment(event.start);
                                    },
                                });
                            } else {
                                //dumb solution but working ^^"
                                $.ajax({
                                    success: function(response) {
                                        // Dghanich Magic
                                        location.reload();
                                        lastEventDate = moment(event.start);
                                    },
                                });
                            }
                        }, 300);
                    }
                }
            });

            function displayMessage(message) {
                alert(message);
            }
        });
    </script>
</body>

</html>
