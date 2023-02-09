{{--@isset($event)--}}
<div id='calendar'></div>

<!-- moment lib -->
<script src='https://cdn.jsdelivr.net/npm/moment@2.27.0/min/moment.min.js'></script>

<script>
     function renderCalendar() {

        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                   left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'

            },
            events: [
                // my event data

                    @foreach($events as $event)
                {
                    id: '{{ $event->id }}',
                    title: "{!! $event->title !!}",
                    start: '{{ $event->dateIn }}T{{ $event->time_from }}',
                    end: '{{ $event->dateIn }}T{{ $event->time_to }}',
                    color: '{{ $event->color }}',
                    @if($event->time_from == null)
                    start: '{{ $event->dateIn }}',
                    end: '{{ $event->dateIn }}',
                    allDay: true,
                    @else

                    id: '{{ $event->id }}',
                    title: "{!! $event->title !!}",
                    start: '{{ $event->dateIn }}T{{ $event->time_from }}',
                    end: '{{ $event->dateIn }}T{{ $event->time_to }}',
                    color: '{{ $event->color }}',
                    @endif
                },
                @endforeach
            ],


            dateClick: function (info) {
                document.getElementById('start').value = info.dateStr;
                document.getElementById('titley').textContent = 'Add an event';
                document.querySelector('input[name="time_from"]').value = info.date;
                document.querySelector('input[name="time_to"]').value = info.endDate;
                document.getElementById('titley').value = '';
                $('#eventModal').modal('show');

            },
            eventClick: function (info) {
                const event = calendar.getEventById(info.event.id);

                document.getElementById('id').value = event.id;
                document.getElementById('title_edit').value = event.title;
                document.getElementById('start_edit').value = moment(event.startStr).format('YYYY-MM-DD');
                document.getElementById('color_edit').value = event.backgroundColor;
                document.getElementById('time_from_edit').value = moment(event.start).format('HH:mm');
                document.getElementById('time_to_edit').value = moment(event.end).format('HH:mm');
                console.log(document.getElementById('start_edit').value = moment(event.startStr).format('YYYY-MM-DD'));

                //    editEvent(event)
                $('#eventEditModal').modal('show');
                //  editEvent(info.id);;
            },
        });
         calendar.render();
        //
        //
        // eventForm.addEventListener('submit', function (e) {
        //     e.preventDefault();
        //     const title = document.getElementById('titley').value;
        //     // const startE = document.getElementById('start_edit').value =
        //     const start = document.getElementById('start').value;
        //     const color = document.getElementById('color').value;
        //     if (title == '' || start == '' || color == '') {
        //         Swal.fire({
        //             icon: "question",
        //             title: "All inputs required",
        //             text: "You cant save if there is an empty input",
        //             // showCancelButton: true,
        //             cancelButtonText: "Oke",
        //         })
        //     } else {
        //
        //     }

    }
</script>
{{--@endisset--}}
