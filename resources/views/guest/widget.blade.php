<x-guest-layout>
    <div class="w-full h-full mx-auto p-6 bg-gray-900">
        <h2 class="text-xl font-semibold mb-4 text-white">Contact Us</h2>

        <div id="success-message"
             class="hidden bg-green-900 border border-green-600 text-green-300 px-4 py-3 rounded relative mb-4"
             role="alert">
            <span class="block sm:inline">Ticket created successfully!</span>
        </div>

        <div id="error-message"
             class="hidden bg-red-900 border border-red-600 text-red-300 px-4 py-3 rounded relative mb-4"
             role="alert">
            <span class="block sm:inline">Something went wrong. Please try again.</span>
        </div>

        <form id="ticket-form" class="space-y-4" novalidate>
            <div>
                <label for="name" class="block text-sm font-medium text-white mb-1">Name</label>
                <input type="text" id="name" name="name" required
                       class="w-full rounded-md bg-gray-800 text-white border border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
                <input type="email" id="email" name="email" required
                       class="w-full rounded-md bg-gray-800 text-white border border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-white mb-1">Phone</label>
                <input type="tel" id="phone" name="phone" required
                       class="w-full rounded-md bg-gray-800 text-white border border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm"
                       placeholder="+1234567890">
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-white mb-1">Subject</label>
                <input type="text" id="subject" name="subject" required
                       class="w-full rounded-md bg-gray-800 text-white border border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm">
            </div>

            <div>
                <label for="text" class="block text-sm font-medium text-white mb-1">Message</label>
                <textarea id="text" name="text" rows="4" required
                          class="w-full rounded-md bg-gray-800 text-white border border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm resize-none"></textarea>
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-white mb-1">Attachment</label>
                <input type="file" id="file" name="file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                       class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-gray-400 mt-1">Max 5MB. Supported: PDF, Images, Docs.</p>
            </div>

            <button type="submit" id="submit-btn"
                    class="w-full flex items-center justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                <span id="btn-text">Submit Ticket</span>
            </button>
        </form>
    </div>

    <script>
        const form = document.getElementById('ticket-form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const successMsg = document.getElementById('success-message');
        const errorMsg = document.getElementById('error-message');

        function validateForm() {
            let isValid = true;
            const fields = ['name', 'email', 'phone', 'subject', 'text'];
            fields.forEach(field => {
                const el = document.getElementById(field);
                if (!el.value.trim()) {
                    el.classList.add('border-red-500');
                    isValid = false;
                } else {
                    el.classList.remove('border-red-500');
                }
            });
            const email = document.getElementById('email').value.trim();
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById('email').classList.add('border-red-500');
                isValid = false;
            }
            const file = document.getElementById('file').files[0];
            if (file && file.size > 5 * 1024 * 1024) {
                isValid = false;
            }
            return isValid;
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (!validateForm()) return;

            submitBtn.disabled = true;
            btnText.textContent = 'Sending...';
            successMsg.classList.add('hidden');
            errorMsg.classList.add('hidden');

            const formData = new FormData(form);

            try {
                const response = await fetch('/api/tickets', {method: 'POST', body: formData});
                let data = null;
                if (response.headers.get('content-type')?.includes('application/json')) {
                    data = await response.json();
                }

                if (response.ok) {
                    successMsg.classList.remove('hidden');
                    form.reset();
                } else {
                    errorMsg.textContent = data?.message || 'Something went wrong.';
                    errorMsg.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                errorMsg.textContent = 'Network error. Please try again.';
                errorMsg.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                btnText.textContent = 'Submit Ticket';
            }
        });

        ['name', 'email', 'phone', 'subject', 'text'].forEach(field => {
            document.getElementById(field).addEventListener('input', () => document.getElementById(field).classList.remove('border-red-500'));
        });
    </script>
</x-guest-layout>