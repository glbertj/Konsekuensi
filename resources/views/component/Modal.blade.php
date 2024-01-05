
<?php
$projectId = 1;
$totalScore = 0.1;
$fullScore = 0.1;
$i = 0;
$check = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .checks {
            margin-right: 6px;
            color: rgb(6, 185, 6);
            padding-top: 0;
            margin-top: 0;
            width: 30px;
            height: 30px;
        }

        label {
            font-weight: 500;
            color: #f50000;
            cursor: pointer;
        }

        .checks::before {
            accent-color: rgb(138, 0, 0);
        }

        .checks:checked {
            accent-color: rgb(0, 135, 20);
        }

        .checks:checked ~ label {
            color: rgb(0, 135, 20);
        }
    
    </style>
</head>
<body>
    @include("layout.main")
    @section('mainContent')

  <!-- Modal -->
    <div id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                {{-- {{dd($aku)}} --}}
                @foreach($project_table as $item1)

                    @if($item1->id == implode(',', $aku))
                        <div class="modal-header"><h3>{{$item1->title}}</h3>
                          <br>
                          <form action="{{route('project')}}" method="get">
                              <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </form>
                        </div>
                    @endif
                @endforeach
                <div class="modal-body">
                    <p class="fs-6 fw-bold">Due Date: </p>
                    <p class="fs-6 fw-bold">To-Do List:</p>
                    <form action="{{route('updateStatus')}}" method = "post">
                        @csrf
                        <ol class="list-group-numbered">
                            <input type="hidden" value ="{{ implode(',', $aku) }}" name="proid">
                            @php
                                $check = 0;
                            @endphp
                            @foreach($list as $item)
                                @if($item->project_id== implode(',', $aku))
                                    <input type="hidden" value = {{$item->id}} name = "countall">
                                    @if($check == 0)
                                        <input type="hidden" value = "{{$item->id}}" name = "i">
                                        @php
                                            $check = 1;
                                            // dd($project_user);
                                            $i = $item->id;
                                        @endphp
                                    @endif
                                    @php
                                        $fullScore += $item->score
                                    @endphp

                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ $item->list }}</div>
                                        </div>
                                        @foreach ($project_user as $items)
                                            @if ($item->id == $items->list_id && $items->status == true)
                                                {{-- {{dd($items)}} --}}
                                                <?php $totalScore += $item->score; ?>
                                                @if(Auth::user()->role != "trainer")
                                                    <input type="checkbox" name="checks{{$i}}" class="checks" id="checks{{ $i }}" checked data-project-id="{{ implode(',', $aku) }}">
                                                    <label class="form-check-label text-success" for="checks{{ $i }}">{{ $item->score }}</label>
                                                @else
                                                    <label class="form-check-label text-success" for="checks{{ $i }}">{{ $item->score }}</label>
                                                @endif

                                            @endif
                                            @if($item->id == $items->list_id && $items->status == false)
                                                @if(Auth::user()->role != "trainer")
                                                <input type="checkbox" name="checks{{$i}}" class="checks" id="checks{{ $i }}" data-project-id="{{ implode(',', $aku) }}">
                                                <label for="checks{{ $i }}">{{ $item->score }}</label>
                                                @else
                                                    <label class="form-check-label text-success" for="checks{{ $i }}">{{ $item->score }}</label>
                                                @endif

                                            @endif
                                        @endforeach
                                    </li>
                                    @php
                                        $i++;
                                    @endphp
                                @endif
                            @endforeach

                        </ol>
                        @if(Auth::user()->role != "trainer")
                        <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar {{ $totalScore == $fullScore ? 'bg-success' : 'bg-danger' }}" style="width: {{ number_format($totalScore/$fullScore*100, 2, '.', '') }}%">{{ number_format($totalScore/$fullScore*100, 2, '.', '') }}%</div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save progress</button>
                        </div>
                        @endif
                    </form>
                    <div class="modal-footer">
                        <form action="{{route('project')}}" method="get">
                            <button type="submit" class="btn btn-secondary">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  {{-- @include('component.Modal', ['users' => $users, 'project_user' => $project_user, 'project_table' => $project_table, 'list' => $list]) --}}
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var projectId = button.val(); // Get the value from the button
        var projectId = <?php echo json_encode($projectId); ?>;
        $('#project-id').text(projectId);
        $('#project-id-input').val(projectId); // Set the value to the hidden input
    });
    $(document).ready(function() {
        var totalScore = <?php echo $totalScore; ?>; // Initialize totalScore with the initial value

        $('.checks').on('change', function() {
            var isChecked = $(this).prop('checked');
            var projectId = $(this).data('project-id');
            var score = parseFloat($(this).next('label').text()); // Get the score associated with the checkbox
            console.log('isChecked: ' + isChecked);
            if (isChecked) {
                totalScore += score;
                $(this).next('label').removeClass('text-danger').addClass('text-success');

            } else {
                totalScore -= score; // Add the score if unchecked
                $(this).next('label').removeClass('text-success').addClass('text-danger');
            }
            updateProgressBar(totalScore);
        });

        function updateProgressBar(totalScore) {
            var fullScore = <?php echo $fullScore; ?>;
            var progressPercentage = (totalScore / fullScore) * 100;

            $('.progress-bar').css('width', progressPercentage + '%');
            $('.progress-bar').removeClass('bg-success bg-danger').addClass(totalScore == fullScore ? 'bg-success' : 'bg-danger');
            $('.progress-bar').text(progressPercentage.toFixed(2) + '%');
        }
    });

</script>
</html>






