<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Smart English') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 pt-4 bg-white dark:bg-gray-900">
                    <div>
                        <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                type="button">
                            <span class="sr-only">Action button</span>
                            Sort by Status
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div id="dropdownAction"
                             class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownActionButton">
                                <li>
                                <li id="sortAll" value="all"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    All
                                </li>
                                <li>
                                <li id="sortCalled" value="Called"
                                    class="block  px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Called
                                </li>
                                <li>
                                <li id="sortUncalled" value="Uncalled"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    UnCalled
                                </li>
                            </ul>
                        </div>
                    </div>

                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search-users"
                               class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Search for users">
                    </div>
                </div>


                <!-- Add an ID to the table for targeting -->
                <table id="users-table"
                       class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">ID</th>
                        <th scope="col" class="px-6 py-3">Full Name</th>
                        <th scope="col" class="px-6 py-3">Group</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Gender</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                    </thead>
                    <tbody id="user-data">

                    <!-- Dynamic rows will be added here -->
                    </tbody>
                </table>
                <div id="user_found" class="flex justify-center p-6  hidden ">No Users Founded</div>

            </div>
        </div>
    </div>

    {{--    Open Modal--}}

    <!-- Modal Structure -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
         class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%)] max-h-full z-50">
        <div class="relative p-4 w-full max-w-md max-h-full  rounded-lg shadow-lg">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Students Info
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal" id="closeModalBtn">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <!-- Full Name Field -->
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                                name</label>
                            <input type="text" name="full_name" id="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Type your full name" required="">
                        </div>

                        <!-- Gender Field (Radio Buttons) -->
                        <div class="col-span-2 sm:col-span-1">
                            <h3 class="flex justify-center mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Choose your gender</h3>
                            <div class="gender center">
                                <div class="maleRadio">
                                    <input type="radio" name="myGender" value="Male" class="male hidden"
                                           id="masculino"/>
                                    <label for="masculino"></label>
                                </div>
                                <div class="femaleRadio">
                                    <input type="radio" name="myGender" value="Female" class="female hidden"
                                           id="femenino"/>
                                    <label for="femenino"></label>
                                </div>
                            </div>
                        </div>

                        <!-- Group Field (Select Dropdown) -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="group" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edit
                                Group</label>
                            <select id="group" name="group"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Edit a Group</option>

                            </select>

                            <label for="statusCh" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edit
                                Status</label>
                            <select id="statusCh" name="group"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="Called">Called</option>
                                <option value="Uncalled">Uncalled</option>


                            </select>
                        </div>

                        <!-- Product Description Field -->
                        <div class="col-span-2">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Description</label>
                            <textarea id="description" name="description" rows="4"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                      placeholder="Write product description here"></textarea>
                        </div>
                    </div>

                    <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Add new product
                    </button>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/users')
            .then(response => response.json())
            .then(data => {
                console.log(data);

                let usersTableBody = document.querySelector('table tbody');
                usersTableBody.innerHTML = '';

                let selectElement = document.querySelector('select');
                selectElement.innerHTML = '';

                data.forEach(user => {
                    let row = document.createElement('tr');
                    row.classList.add('bg-white', 'border-b', 'dark:bg-gray-800', 'dark:border-gray-700', 'hover:bg-gray-50', 'dark:hover:bg-gray-600', 'capitalize');

                    let statusCell = '';
                    if (user.status === 'Called') {
                        statusCell = `
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Called
                            </div>
                        </td>
                    `;
                    } else {
                        statusCell = `
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Uncalled
                            </div>
                        </td>
                    `;
                    }

                    row.innerHTML = `
                    <td class="w-4 p-4">${user.id}</td>
                    <td class="px-6 py-4">${user.full_name}</td>
                    <td class="px-6 py-4">${user.group}</td>
                    ${statusCell}
                    <td class="px-6 py-4">${user.gender}</td>
                    <td class="px-6 py-4">
                        <button onclick="openModal(${user.id}, '${user.full_name}', '${user.group}', '${user.gender}', '${user.status}')" class="text-blue-600 hover:text-blue-800">Edit</button>
                    </td>
                `;

                    usersTableBody.appendChild(row);


                });
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            });
    });


    // Group Fetch

    document.addEventListener('DOMContentLoaded', function () {

        fetch('/users')
            .then(response => response.json())
            .then(data => {
                console.log(data);


                let selectElement = document.querySelector('select');
                selectElement.innerHTML = '';
                data.forEach(user => {

                    let option = document.createElement('option');
                    option.value = user.group;
                    option.textContent = user.group;
                    selectElement.appendChild(option);
                });
            });
    })


    // SEARCH
    document.getElementById('table-search-users').addEventListener('input', function (e) {
        const searchTerm = e.target.value.toLowerCase();

        // Check if the search input is empty and show the table
        if (searchTerm === '') {
            document.querySelector("table").classList.remove('none');
            document.getElementById('user_found').classList.add('hidden');
        }

        let matchFound = false;  // Flag to track if any row matches the search term

        document.querySelectorAll('#users-table tbody tr').forEach(row => {
            const fullName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

            if (fullName.includes(searchTerm)) {
                row.style.display = '';  // Show the row
                matchFound = true;  // At least one row matches
                document.getElementById('user_found').classList.add('hidden');
            } else {
                row.style.display = 'none';  // Hide the row
            }
        });

        if (!matchFound && searchTerm !== '') {
            document.querySelector("table").classList.add('none');  // Hide the table if no matches
            document.getElementById('user_found').classList.remove('hidden');
        }
    });


    // SORT
    document.addEventListener('DOMContentLoaded', function () {
        // Event listeners for the "All", "Called", and "Uncalled" buttons
        document.getElementById('sortAll').addEventListener('click', function () {
            filterRows('all');
        });

        document.getElementById('sortCalled').addEventListener('click', function () {
            filterRows('called');
        });

        document.getElementById('sortUncalled').addEventListener('click', function () {
            filterRows('uncalled');
        });

        // Function to filter rows based on the status
        function filterRows(status) {
            let matchFound = false;

            // Loop through table rows
            document.querySelectorAll('#users-table tbody tr').forEach(row => {
                // Extract the status text (clean up by trimming and converting to lowercase)
                const statusText = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();

                // Adjust the filtering logic to check for exact matches
                if (status === 'all') {
                    row.style.display = '';  // Show all rows
                    matchFound = true;
                } else if (status === 'called' && statusText === 'called') {
                    row.style.display = '';  // Show rows with 'Called' status
                    matchFound = true;
                } else if (status === 'uncalled' && statusText === 'uncalled') {
                    row.style.display = '';  // Show rows with 'Uncalled' status
                    matchFound = true;
                } else {
                    row.style.display = 'none';  // Hide rows that don't match
                }
            });

            // Show or hide the "No results found" message based on whether there are matches
            if (!matchFound) {
                document.querySelector("table").classList.add('none');
                document.getElementById('user_found').classList.remove('hidden');
            } else {
                document.querySelector("table").classList.remove('none');
                document.getElementById('user_found').classList.add('hidden');
            }
        }
    });


    const modal = document.getElementById("crud-modal");
    const closeModalBtn = document.getElementById("closeModalBtn");


    function openModal(id, full_name, gender, group, status) {
        modal.classList.remove("hidden");

        document.getElementById("name").value = full_name;

        document.querySelector("input[name='myGender'][value='" + gender + "']").checked = true;

        document.getElementById("group").value = group;
        document.getElementById("status").value = status;
    }


    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", function () {
            modal.classList.add("hidden");
        });
    }

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });

</script>

