<?php
$questions = get_random_questions();
?>

<style>
table {
    background: lightyellow;
    border: 3px solid gold;
}

th {
    background: lightyellow;
    text-align: left;
}

td {
    background: wheat;
    text-align: center;
    cursor: pointer;
}
</style>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $index = 1; ?>
        <?php foreach ($questions as $question): ?>
            <tr>
                <td data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES, 'UTF-8'); ?>'><?php echo htmlspecialchars($question['id']); ?></td>
                <td data-question='<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES, 'UTF-8'); ?>'><?php echo htmlspecialchars($question['body']); ?></td>
            </tr>
            <?php $index++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
document.querySelectorAll('#questions-table td').forEach(cell => {
    cell.addEventListener('mouseenter', function() {
        this.style.fontWeight = 'bold';
    });
    
    cell.addEventListener('mouseleave', function() {
        this.style.fontWeight = 'normal';
    });
    
    cell.addEventListener('click', function() {
        const questionData = JSON.parse(this.getAttribute('data-question'));
        const popup = document.getElementById('question-popup');
        if (popup) {
            popup.style.visibility = 'visible';
            popup.dataset.question = JSON.stringify(questionData);
            if (typeof updateQuestionPopup === 'function') {
                updateQuestionPopup(questionData);
            }
        }
    });
});
</script>
