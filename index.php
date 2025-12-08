<?php
function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    $questions = array_slice($questions, 0, 2);
    return $questions;
}

function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    $questions = array_slice($questions, 0, 2);
    return $questions;
}

function component_questions_list_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    $questions = array_slice($questions, 0, 4);
    return $questions;
}

$questions_table_data = component_questions_table_datasource();
$questions_list_data = component_questions_list_datasource();
?>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $row_index = 1; foreach ($questions_table_data as $question): ?>
        <tr data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>'>
            <td><?php echo htmlspecialchars($question['id']); ?></td>
            <td><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php $row_index++; endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php $para_index = 0; foreach ($questions_list_data as $question): ?>
    <p class="<?php echo ($para_index % 2 == 0) ? 'odd-para' : 'even-para'; ?>" data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>'>
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php $para_index++; endforeach; ?>
</section>

<div id="question-popup">
    <div id="question-popup-text"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const questionTable = document.getElementById('questions-table');
    const questionsList = document.getElementById('questions-list');
    const questionPopup = document.getElementById('question-popup');
    const questionPopupText = document.getElementById('question-popup-text');
    
    if (questionTable) {
        const cells = questionTable.querySelectorAll('tbody td');
        cells.forEach(cell => {
            cell.addEventListener('mouseenter', function() {
                this.style.fontWeight = 'bold';
            });
            cell.addEventListener('mouseleave', function() {
                this.style.fontWeight = 'normal';
            });
            cell.addEventListener('click', function() {
                const row = this.closest('tr');
                const questionData = JSON.parse(row.getAttribute('data-question'));
                questionPopupText.textContent = questionData.body;
                questionPopup.style.visibility = 'visible';
            });
        });
    }
    
    if (questionsList) {
        const paragraphs = questionsList.querySelectorAll('p');
        paragraphs.forEach(para => {
            para.addEventListener('mouseenter', function() {
                this.style.fontWeight = 'bold';
                this.style.cursor = 'progress';
            });
            para.addEventListener('mouseleave', function() {
                this.style.fontWeight = 'normal';
            });
            para.addEventListener('click', function() {
                const questionData = JSON.parse(this.getAttribute('data-question'));
                questionPopupText.textContent = questionData.body;
                questionPopup.style.visibility = 'visible';
            });
        });
    }
    
    if (questionPopup) {
        document.addEventListener('click', function(e) {
            if (!questionPopup.contains(e.target) && questionPopup.style.visibility === 'visible') {
                if (e.target.tagName !== 'TD' && !e.target.classList.contains('odd-para') && !e.target.classList.contains('even-para')) {
                    questionPopup.style.visibility = 'hidden';
                }
            }
        });
    }
});
</script>

<style>
#questions-table {
    background: lightyellow;
    border: 3px solid gold;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
}

#questions-table thead th {
    background: lightyellow;
    text-align: left;
    padding: 8px;
    border: 1px solid gold;
}

#questions-table tbody td {
    background: wheat;
    text-align: center;
    padding: 8px;
    border: 1px solid gold;
    cursor: pointer;
}

#questions-list {
    width: 100%;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px;
    cursor: pointer;
}

#questions-list p.odd-para {
    background: lightcoral;
}

#questions-list p.even-para {
    background: red;
    color: white;
}

#question-popup {
    width: 400px;
    height: 300px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #27CCF5;
    visibility: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-sizing: border-box;
    z-index: 1000;
    border-radius: 8px;
}

#question-popup-text {
    color: white;
    text-align: center;
    word-wrap: break-word;
    overflow-y: auto;
    max-height: 100%;
}

@media (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table thead th,
    #questions-table tbody td {
        padding: 6px;
    }
    
    #question-popup {
        width: 90%;
        max-width: 400px;
        height: auto;
        min-height: 200px;
        max-height: 80vh;
    }
    
    #questions-list p {
        margin-left: 5px;
        margin-right: 5px;
        padding: 8px;
        font-size: 14px;
    }
}
</style>

