<div id="question-popup">
    <?= htmlspecialchars($question->body) ?>
</div>

<style>
#question-popup {
    width: 400px;
    height: 300px;
    background: #27CCF5;
    visibility: hidden;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
}

@media (max-width: 768px) {
    #question-popup {
        width: 90%;
        max-width: 400px;
    }
}
</style>

<script>
document.addEventListener('click', function(e) {
    const popup = document.getElementById('question-popup');
    if (!popup.contains(e.target)) {
        popup.style.visibility = 'hidden';
    }
});
</script>
