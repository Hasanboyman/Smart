<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight select-none">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="dark py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Reports Table Container -->
            <div class="overflow-hidden shadow-lg rounded-lg bg-gradient-to-br from-gray-100 via-white to-gray-200 dark:from-gray-800 dark:via-gray-900 dark:to-gray-700">
                <table id="export-table" class="min-w-full table-auto">
                    <thead class="bg-gradient-to-r from-gray-300 via-gray-200 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase">
                            Id
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase">
                            Report Title
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase">
                            Subject
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase">
                            Comment
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-800 dark:text-gray-200 uppercase">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($reports as $report)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-300">{{ $report->id }}</td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-300">{{ $report->rating }}</td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-300">{{ Str::limit($report->title, 50, '...') }}</td>
                            <td class="px-6 py-4 text-gray-600 italic dark:text-gray-400">
                                {{ Str::limit($report->message, 90, '...') }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($report->status === 'pending')
                                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                    Pending
                </span>
                                @elseif ($report->status === 'solved')
                                    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                    Solved
                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button onclick="OpenModal({{ $report->id }},'{{ $report->message }}','{{ $report->title }}','{{ $report->created_at }}','{{ $report->status }}')" class="relative overflow-hidden rounded-md bg-neutral-950 px-5 py-2.5 text-white duration-300 [transition-timing-function:cubic-bezier(0.175,0.885,0.32,1.275)] active:translate-y-1 active:scale-x-110 active:scale-y-90">Preview</button>
                            </td>
                        </tr>
                    @endforeach
                    <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto m-4 transform transition-transform duration-300 scale-95" style="background-image: linear-gradient(to bottom right, #ffffff, #f8fafc);">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 id="modalTitle" class="text-2xl font-bold text-gray-800">Report Preview</h2>
                    <button id="closeModal" onclick="closeModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <div class="bg-white rounded-lg p-4 mb-6">
                    <div class="space-y-4">
                        <div class="flex flex-col space-y-2">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-600">To: <span id="title" class="text-gray-800 font-medium">Marketing Department</span></p>
                                    <p class="text-gray-600">Status: <span id="status" class="text-gray-800 font-medium">Pending</span></p>
                                </div>
                                <div class="text-right">
                                    <p id="date" class="text-sm text-gray-500">Date: </p>
                                    <p id="time" class="text-sm text-gray-500">Time: </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p id="report" class="text-gray-700">

                            </p>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Feedback Section</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="feedbackText" class="block text-sm font-medium text-gray-700 mb-1">Your Feedback</label>
                                    <textarea id="feedbackText" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Please provide your feedback here..." required="required"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Update Buttons -->
                <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-2">
                        <input type="radio" id="solved" name="status" value="solved" class="hidden peer" />
                        <label for="solved" class="cursor-pointer flex items-center px-4 py-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors duration-300 ease-in-out transform peer-checked:bg-blue-500 peer-checked:text-white peer-checked:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                        <span class="mr-2">
                            <i class="fa-solid fa-check "></i>
                        </span>
                            Solved
                        </label>
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="radio" id="pending" name="status" value="pending" class="hidden peer" />
                        <label for="pending" class="cursor-pointer flex items-center px-4 py-2 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition-colors duration-300 ease-in-out transform peer-checked:bg-yellow-500 peer-checked:text-white peer-checked:shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                        <span class="mr-2">
                            <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                        </span>
                            Pending
                        </label>
                    </div>
                </div>

                <!-- Submit Button to Save the Status -->
                <div class="flex justify-end">
                    <button id="submitStatus" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 transition-all ease-in-out duration-300 transform hover:scale-105 shadow-lg">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>

        const modal = document.getElementById("modal");
        const closeButton = document.getElementById("closeModal");
        let reportId;
        function OpenModal(id, message, title, time,status) {
            reportId = id;
            const modal = document.getElementById("modal");
            modal.classList.remove("opacity-0", "pointer-events-none");
            modal.querySelector(".max-w-2xl").classList.remove("scale-95");
            modal.querySelector(".max-w-2xl").classList.add("scale-100");


            modal.querySelector("#title").textContent = title;
            modal.querySelector("#report").textContent = message;


            console.log(time)
            const timestamp = new Date(time);
            const formattedDate = timestamp.toLocaleDateString('en-US', {
                month: 'short',
                day: '2-digit',
                year: 'numeric'
            });
            const formattedTime = timestamp.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false,
                timeZoneName: 'short',
            });

            modal.querySelector("#date").textContent = `Date: ${formattedDate}`;
            modal.querySelector("#time").textContent = `Time: ${formattedTime}`;


            const statusElement = modal.querySelector("#status");
            statusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1).toLowerCase();
            statusElement.style.color = status.toLowerCase() === "solved" ? "green" : "orange";

            const solvedRadio = document.getElementById("solved");
            const pendingRadio = document.getElementById("pending");



            if (status.toLowerCase() === "solved") {
            solvedRadio.checked = true;
            pendingRadio.checked = false;
            } else if (status.toLowerCase() === "pending") {
            solvedRadio.checked = false;
            pendingRadio.checked = true;
            }

        }



        function closeModal() {
            modal.classList.add("opacity-0", "pointer-events-none");
            modal.querySelector(".max-w-2xl").classList.remove("scale-100");
            modal.querySelector(".max-w-2xl").classList.add("scale-95");
        }

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeModal();
        });
        modal.addEventListener("click", (e) => {
            if (e.target === modal) closeModal();
        });

        closeButton.addEventListener("click", closeModal);



        document.getElementById('submitStatus').addEventListener('click', function () {
            let selectedStatus = document.querySelector('input[name="status"]:checked').value;
            feedback = document.getElementById('feedbackText').value;


            const data = {
                status: selectedStatus,
                feedback: feedback,
            };

            $.ajax({
                url: `/reports/${reportId}`,
                method: 'PUT',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token
                },
                success: function (response) {
                    const messageContainer = document.getElementById('notification-message');
                    messageContainer.innerHTML = response.message;
                    document.getElementById('notification').classList.remove("hidden");

                    setTimeout(function () {
                        document.getElementById('notification').classList.add("hidden");
                    }, 3000);

                    const selectedStatus = response.status;
                    const feedback = response.feedback;

                    document.querySelector('#status').textContent = selectedStatus.charAt(0).toUpperCase() + selectedStatus.slice(1).toLowerCase();
                    document.querySelector('#status').style.color = selectedStatus.toLowerCase() === "solved" ? "green" : "orange";

                    if (document.querySelector('#feedbackText')) {
                        document.querySelector('#feedbackText').value = feedback;
                    }

                    setTimeout(function () {
                        location.reload();
                    }, 2000);

                    closeModal();
                },
                error: function (xhr, error, message) {
                    const messageContainer = document.getElementById('error-message');


                    const errorMessage = xhr.responseJSON?.message || 'An error occurred while updating the user.';

                    console.error(xhr.xhr?.error);

                    messageContainer.innerHTML = errorMessage;
                    document.getElementById('error-notification').classList.remove("hidden");

                    setTimeout(function () {
                        document.getElementById('error-notification').classList.add("hidden");
                    }, 3000);

                }
            });
        });

    </script>

    <script>

        if (document.getElementById("export-table") && typeof simpleDatatables.DataTable !== 'undefined') {

        const exportCustomCSV = function(dataTable, userOptions = {}) {
        const clonedUserOptions = {
        ...userOptions
        }
        clonedUserOptions.download = false
        const csv = simpleDatatables.exportCSV(dataTable, clonedUserOptions)
        if (!csv) {
        return false
        }
        const defaults = {
        download: true,
        lineDelimiter: "\n",
        columnDelimiter: ";"
        }
        const options = {
        ...defaults,
        ...clonedUserOptions
        }
        const separatorRow = Array(dataTable.data.headings.filter((_heading, index) => !dataTable.columns.settings[index]?.hidden).length)
        .fill("+")
        .join("+"); // Use "+" as the delimiter

        const str = separatorRow + options.lineDelimiter + csv + options.lineDelimiter + separatorRow;

        if (userOptions.download) {
        // Create a link to trigger the download
        const link = document.createElement("a");
        link.href = encodeURI("data:text/csv;charset=utf-8," + str);
        link.download = (options.filename || "datatable_export") + ".txt";
        // Append the link
        document.body.appendChild(link);
        // Trigger the download
        link.click();
        // Remove the link
        document.body.removeChild(link);
        }

        return str
        }
        const table = new simpleDatatables.DataTable("#export-table", {
            perPage:5,
        template: (options, dom) => "<div class='" + options.classes.top + "'>" +
            "<div class='flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-3 rtl:space-x-reverse w-full sm:w-auto'>" +
                (options.paging && options.perPageSelect ?
                "<div class='" + options.classes.dropdown + "'>" +
                    "<label>" +
                        "<select class='" + options.classes.selector + "'></select> " + options.labels.perPage +
                        "</label>" +
                    "</div>" : ""
                ) + "<button id='exportDropdownButton' type='button' class='flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto'>" +
                    "Export as" +
                    "<svg class='-me-0.5 ms-1.5 h-4 w-4' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' viewBox='0 0 24 24'>" +
                        "<path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m19 9-7 7-7-7' />" +
                        "</svg>" +
                    "</button>" +
                "<div id='exportDropdown' class='z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700' data-popper-placement='bottom'>" +
                    "<ul class='p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400' aria-labelledby='exportDropdownButton'>" +
                        "<li>" +
                            "<button id='export-csv' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
                                "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
                                    "<path fill-rule='evenodd' d='M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm1.018 8.828a2.34 2.34 0 0 0-2.373 2.13v.008a2.32 2.32 0 0 0 2.06 2.497l.535.059a.993.993 0 0 0 .136.006.272.272 0 0 1 .263.367l-.008.02a.377.377 0 0 1-.018.044.49.49 0 0 1-.078.02 1.689 1.689 0 0 1-.297.021h-1.13a1 1 0 1 0 0 2h1.13c.417 0 .892-.05 1.324-.279.47-.248.78-.648.953-1.134a2.272 2.272 0 0 0-2.115-3.06l-.478-.052a.32.32 0 0 1-.285-.341.34.34 0 0 1 .344-.306l.94.02a1 1 0 1 0 .043-2l-.943-.02h-.003Zm7.933 1.482a1 1 0 1 0-1.902-.62l-.57 1.747-.522-1.726a1 1 0 0 0-1.914.578l1.443 4.773a1 1 0 0 0 1.908.021l1.557-4.773Zm-13.762.88a.647.647 0 0 1 .458-.19h1.018a1 1 0 1 0 0-2H6.647A2.647 2.647 0 0 0 4 13.647v1.706A2.647 2.647 0 0 0 6.647 18h1.018a1 1 0 1 0 0-2H6.647A.647.647 0 0 1 6 15.353v-1.706c0-.172.068-.336.19-.457Z' clip-rule='evenodd'/>" +
                                    "</svg>" +
                                "<span>Export CSV</span>" +
                                "</button>" +
                            "</li>" +
                        "<li>" +
                            "<button id='export-json' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
                                "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
                                    "<path fill-rule='evenodd' d='M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm-.293 9.293a1 1 0 0 1 0 1.414L9.414 14l1.293 1.293a1 1 0 0 1-1.414 1.414l-2-2a1 1 0 0 1 0-1.414l2-2a1 1 0 0 1 1.414 0Zm2.586 1.414a1 1 0 0 1 1.414-1.414l2 2a1 1 0 0 1 0 1.414l-2 2a1 1 0 0 1-1.414-1.414L14.586 14l-1.293-1.293Z' clip-rule='evenodd'/>" +
                                    "</svg>" +
                                "<span>Export JSON</span>" +
                                "</button>" +
                            "</li>" +
                        "<li>" +
                            "<button id='export-txt' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
                                "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
                                    "<path fill-rule='evenodd' d='M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z' clip-rule='evenodd'/>" +
                                    "</svg>" +
                                "<span>Export TXT</span>" +
                                "</button>" +
                            "</li>" +
                        "<li>" +
                            "<button id='export-sql' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white'>" +
                                "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
                                    "<path d='M12 7.205c4.418 0 8-1.165 8-2.602C20 3.165 16.418 2 12 2S4 3.165 4 4.603c0 1.437 3.582 2.602 8 2.602ZM12 22c4.963 0 8-1.686 8-2.603v-4.404c-.052.032-.112.06-.165.09a7.75 7.75 0 0 1-.745.387c-.193.088-.394.173-.6.253-.063.024-.124.05-.189.073a18.934 18.934 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.073a10.143 10.143 0 0 1-.852-.373 7.75 7.75 0 0 1-.493-.267c-.053-.03-.113-.058-.165-.09v4.404C4 20.315 7.037 22 12 22Zm7.09-13.928a9.91 9.91 0 0 1-.6.253c-.063.025-.124.05-.189.074a18.935 18.935 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.074a10.163 10.163 0 0 1-.852-.372 7.816 7.816 0 0 1-.493-.268c-.055-.03-.115-.058-.167-.09V12c0 .917 3.037 2.603 8 2.603s8-1.686 8-2.603V7.596c-.052.031-.112.059-.165.09a7.816 7.816 0 0 1-.745.386Z'/>" +
                                    "</svg>" +
                                "<span>Export SQL</span>" +
                                "</button>" +
                            "</li>" +
                        "</ul>" +
                    "</div>" + "</div>" +
            (options.searchable ?
            "<div class='" + options.classes.search + "'>" +
                "<input class='" + options.classes.input + "' placeholder='" + options.labels.placeholder + "' type='search' title='" + options.labels.searchTitle + "'" + (dom.id ? " aria-controls='" + dom.id + "'" : "") + ">" +
                "</div>" : ""
            ) +
            "</div>" +
        "<div class='" + options.classes.container + "'" + (options.scrollY.length ? " style='height: " + options.scrollY + "; overflow-Y: auto;'" : "") + "></div>" +
        "<div class='" + options.classes.bottom + "'>" +
            (options.paging ?
            "<div class='" + options.classes.info + "'></div>" : ""
            ) +
            "<nav class='" + options.classes.pagination + "'></nav>" +
            "</div>"
        })
        const $exportButton = document.getElementById("exportDropdownButton");
        const $exportDropdownEl = document.getElementById("exportDropdown");
        const dropdown = new Dropdown($exportDropdownEl, $exportButton);
        console.log(dropdown)

        document.getElementById("export-csv").addEventListener("click", () => {
        simpleDatatables.exportCSV(table, {
        download: true,
        lineDelimiter: "\n",
        columnDelimiter: ";"
        })
        })
        document.getElementById("export-sql").addEventListener("click", () => {
        simpleDatatables.exportSQL(table, {
        download: true,
        tableName: "export_table"
        })
        })
        document.getElementById("export-txt").addEventListener("click", () => {
        simpleDatatables.exportTXT(table, {
        download: true
        })
        })
        document.getElementById("export-json").addEventListener("click", () => {
        simpleDatatables.exportJSON(table, {
        download: true,
        space: 3
        })
        })
        }
    </script>
</x-app-layout>
