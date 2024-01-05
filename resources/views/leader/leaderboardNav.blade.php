<?php
$uniqueListIds = [];
?>
{{-- {{dd($leaderboard)}} --}}
<select onchange="updateSelectedProject()" id="leaderboardSelect">
    @if($projecttit == null)
        <option value="">Choose Project</option>
    @endif
    @if ($projecttit != null)
        <option value="">{{$projecttit}}</option>
    @endif


@foreach ($leaderboard as $projectnav)
    <?php if (!in_array($projectnav->project_id, $uniqueListIds)): ?>
        <option value="{{route('leaderboard.show', $projectnav->project_id,$projectnav->project_title)}}">{{$projectnav->project_title}}</option>
        <?php $uniqueListIds[] = $projectnav->project_id; ?>
    <?php endif; ?>
@endforeach
</select>

<div id="selectedProject"></div>

<script>
    function updateSelectedProject() {

        var selectedUrl = $('#leaderboardSelect').val();
        window.location.href = selectedUrl;
    }
</script>
