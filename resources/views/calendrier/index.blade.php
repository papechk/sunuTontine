@extends('layouts.admin')
@section('head')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js'></script>
@endsection
@section('page_title', 'Calendrier')
@section('admin_content')
<div class="card">
    <div class="flex flex-col gap-4 border-b border-gray-200 pb-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Calendrier des cotisations</h2>
            <p class="text-sm text-gray-500">Planifiez et suivez les cotisations par tontine.</p>
        </div>
        <div class="w-full md:w-72">
            <label class="mb-2 block text-sm font-medium text-gray-700">Tontine</label>
            <select id="tontineSelect" class="input-field">
                <option value="">Selectionner une tontine</option>
                @foreach($tontines as $tontine)
                    <option value="{{ $tontine->id }}" @selected((string) $selectedTontineId === (string) $tontine->id)>
                        {{ $tontine->nom }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="calendar" class="min-h-[540px] pt-4"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var selectEl = document.getElementById('tontineSelect');

        function getTontineId() {
            return selectEl.value || null;
        }

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'fr',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: function(fetchInfo, successCallback, failureCallback) {
                var tontineId = getTontineId();
                var url = '/calendrier' + (tontineId ? ('?tontine_id=' + tontineId) : '');
                fetch(url, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => successCallback(data))
                    .catch(error => failureCallback(error));
            },
            selectable: true,
            select: function(info) {
                var tontineId = getTontineId();
                if (!tontineId) {
                    alert('Veuillez selectionner une tontine.');
                    calendar.unselect();
                    return;
                }

                var montant = prompt('Montant de la cotisation pour le ' + info.startStr + ' ?');
                if (montant) {
                    fetch('/calendrier', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            tontine_id: tontineId,
                            date_cotisation: info.startStr,
                            montant: montant
                        })
                    })
                    .then(response => response.json())
                    .then(() => { calendar.refetchEvents(); });
                }
            },
            eventClick: function(info) {
                if (confirm('Supprimer cette date ?')) {
                    fetch('/calendrier/' + info.event.id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(() => { calendar.refetchEvents(); });
                }
            },
            eventDataTransform: function(event) {
                return {
                    id: event.id,
                    title: event.montant + ' F',
                    start: event.date_cotisation
                };
            }
        });

        selectEl.addEventListener('change', function() {
            calendar.refetchEvents();
        });

        calendar.render();
    });
</script>
@endsection
