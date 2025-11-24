<x-guest-layout>
    <div class="max-w-md mx-auto rounded-lg shadow-md p-6 bg-gray-900 ">
        <h2 class="text-xl font-semibold mb-4 text-white">Contact Us</h2>

        <div id="success-message"
             class="hidden bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded relative mb-4"
             role="alert">
            <span class="block sm:inline">Ticket created successfully!</span>
        </div>

        <div id="error-message"
             class="hidden bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded relative mb-4"
             role="alert">
            <span class="block sm:inline">Something went wrong. Please try again.</span>
        </div>

        <form id="ticket-form" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 text-white">Name</label>
                <input type="text" id="name" name="name" required
                       class="mt-1 block w-full rounded-md  bg-gray-800 text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 text-white">Email</label>
                <input type="email" id="email" name="email" required
                       class="mt-1 block w-full rounded-md  bg-gray-800 text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 text-white">Phone</label>
                <input type="tel" id="phone" name="phone" required placeholder="+1234567890"
                       class="mt-1 block w-full rounded-md  bg-gray-800 text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm">
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 text-white">Subject</label>
                <input type="text" id="subject" name="subject" required
                       class="mt-1 block w-full rounded-md  bg-gray-800 text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm">
            </div>

            <div>
                <label for="text" class="block text-sm font-medium text-gray-700 text-white">Message</label>
                <textarea id="text" name="text" rows="4" required
                          class="mt-1 block w-full rounded-md  bg-gray-800 text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 sm:text-sm"></textarea>
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-700 text-white">Attachment</label>
                <input type="file" id="file" name="file"
                       class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-indigo-900 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800">
            </div>

            <button type="submit" id="submit-btn"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-800 dark:text-gray-200 bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Submit Ticket
            </button>
        </form>
    </div>

    <script>
        document.getElementById('ticket-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const form = e.target;
            const submitBtn = document.getElementById('submit-btn');
            const successMsg = document.getElementById('success-message');
            const errorMsg = document.getElementById('error-message');

            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            successMsg.classList.add('hidden');
            errorMsg.classList.add('hidden');

            const formData = new FormData(form);

            try {
                const response = await fetch('/api/tickets', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    successMsg.classList.remove('hidden');
                    form.reset();
                } else {
                    console.error('Error:', data);
                    errorMsg.textContent = data.message || 'Something went wrong.';
                    errorMsg.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                errorMsg.textContent = 'Network error. Please try again.';
                errorMsg.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Ticket';
            }
        });
    </script>
</x-guest-layout>
