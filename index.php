
<?php
function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 2);
}

function component_questions_list_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 4);
}

function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 2);
}

$questionsTableData = component_questions_table_datasource();
$questionsListData = component_questions_list_datasource();
?>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach ($questionsTableData as $question): ?>
        <tr data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>'>
            <td><?php echo htmlspecialchars($question['id']); ?></td>
            <td><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php $index++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php foreach ($questionsListData as $idx => $question): ?>
    <p class="<?php echo ($idx % 2 === 0) ? 'even' : 'odd'; ?>" data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>'>
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php endforeach; ?>
</section>

<div id="question-popup">
    <div id="question-popup-content"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const questionTable = document.getElementById('questions-table');
    const questionPopup = document.getElementById('question-popup');
    const questionPopupContent = document.getElementById('question-popup-content');
    
    questionTable.querySelectorAll('tbody tr').forEach(function(row) {
        row.addEventListener('click', function(e) {
            const questionData = JSON.parse(this.getAttribute('data-question'));
            questionPopupContent.textContent = questionData.body;
            questionPopup.style.visibility = 'visible';
        });
    });
    
    questionTable.querySelectorAll('tbody td').forEach(function(cell) {
        cell.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
        });
        cell.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
        });
    });
    
    const questionsList = document.getElementById('questions-list');
    questionsList.querySelectorAll('p').forEach(function(paragraph) {
        paragraph.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
            this.style.cursor = 'wait';
        });
        paragraph.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
        });
    });
    
    questionPopup.addEventListener('click', function(e) {
        if (e.target === questionPopup) {
            questionPopup.style.visibility = 'hidden';
        }
    });
});
</script>

<style>
#questions-table {
    background: lightyellow;
    border: 3px solid gold;
    border-collapse: collapse;
    width: 100%;
}

#questions-table thead th {
    background: lightYellow;
    text-align: left;
    padding: 8px;
}

#questions-table tbody td {
    background: wheat;
    text-align: center;
    padding: 8px;
    border: 1px solid #ccc;
}

#questions-list {
    display: block;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px;
}

#questions-list p.odd {
    background: lightcoral;
}

#questions-list p.even {
    background: red;
}

#question-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    visibility: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

#question-popup-content {
    width: 400px;
    height: 300px;
    background: #27CCF5;
    padding: 20px;
    border-radius: 8px;
    overflow: auto;
    box-sizing: border-box;
}

@media (max-width: 768px) {
    #question-popup-content {
        width: 90%;
        max-width: 400px;
        height: auto;
        max-height: 80%;
    }
    
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table thead th,
    #questions-table tbody td {
        padding: 6px;
    }
}
</style>


