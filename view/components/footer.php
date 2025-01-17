<!-- Footer -->
<footer class="sticky bottom-0 bg-white">
    <div class="container mx-auto py-4">
        <div class="text-center">
            <span class="text-gray-700">Copyright &copy; Udemy </span>
            <span id="currentYear" class="text-gray-700"></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<script>
    document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>
