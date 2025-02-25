<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/index.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="mainBox">

        <div class="mobileMenu" id="mobileMenuButton">
            <span class="iconify" data-icon="fe:app-menu"></span>
        </div>

        <nav>
            <h1 class="headerText">.studio</h1>
            <div class="menu">
                <div>
                    <ul>
                        <li>
                            <span class="iconify" data-icon="cil:home"></span>
                            <a href="#">Overview</a>
                        </li>
                        <li>
                            <span class="iconify" data-icon="ps:stats"></span>
                            <a href="#">Stats</a>
                        </li>
                        <li class="active">
                            <span class="iconify" data-icon="heroicons-outline:folder-open"></span>
                            <a href="#">Projects</a>
                        </li>
                        <li>
                            <span class="iconify" data-icon="bi:chat-left-dots"></span>
                            <a href="#">Chat</a>
                            <span class="countChat">2</span>
                        </li>
                        <li>
                            <span class="iconify" data-icon="bx:bx-calendar"></span>
                            <a href="#">Calendar</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <ul>
                        <li>
                            <span class="iconify" data-icon="uiw:setting-o"></span>
                            <a href="#">Settings</a></li>
                        <li>
                            <span class="iconify" data-icon="ic:round-logout"></span>
                            <a href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="mainSec">
            <div class="MainSecHeader">
                <div class="parentSearchBox">
                    <div class="searchDiv">
                        <span class="iconify" data-icon="bi:search"></span>
                        <input type="text" name="searchInput" id="searchInput" placeholder="Search">
                    </div>
                </div>
                <div class="userInfoDiv">
                    <div class="questionBox">
                        <span class="iconify" data-icon="akar-icons:question"></span>
                    </div>
                    <div class="alertBox">
                        <span class="iconify" data-icon="clarity:notification-solid-badged"></span>
                        <span class="iconify" data-icon="akar-icons:circle-fill"></span>
                    </div>
                    <div class="userNameBox">
                        <span>Mohammad Reza</span>
                        <span class="iconify" data-icon="dashicons:arrow-up-alt2"></span>
                    </div>
                    <div class="userNameImage">
                        <img src="assets/images/avatars/avatar0.jpg" alt="User Profile Image">
                    </div>
                </div>
            </div>

            <div class="secHeader">
                <p>Project</p>
                <select name="selectTime" id="selectTime">
                    <option value="This Week">This Week</option>
                </select>
            </div>

            <div class="secBody">

                <div id="mainBox_todo">
                    <div class="secBodyHeader">
                        <h3>To do</h3>
                        <span id="counter_todo">2</span>
                    </div>
                    <div class="secBodyAdd">+</div>
                    <div class="content" ondrop="drop(event)" ondragover="allowDrop(event)">

                        <div class="todoBox" draggable="true" touchstart="drag(event)" ondragstart="drag(event)" id="todo1">
                            <div class="todoHeader">
                                <div class="titleBox">
                                    <span class="dot">.</span>
                                    <span class="title">Design</span>
                                </div>
                                <span class="icon"><span class="iconify" data-icon="iconoir:attachment"></span></span>
                            </div>
                            <div class="todoText">
                                We need 2 different concepts for a software
                                page in our programm. I've attached 2 concepts
                                that will give you an idea to reproduce but
                                with a new look and feel. We'd like to keep
                                the colors similar but you can add different
                                colors. 
                            </div>
                            <div class="todoFooter">
                                <img src="assets/images/avatars/avatar1.jpg">
                                <img src="assets/images/avatars/avatar2.jpg">
                            </div>
                        </div>

                        <div class="todoBox" draggable="true" touchstart="drag(event)" ondragstart="drag(event)" id="todo2">
                            <div class="todoHeader">
                                <div class="titleBox">
                                    <span class="dot">.</span>
                                    <span class="title">Design</span>
                                </div>
                                <span class="icon"><span class="iconify" data-icon="iconoir:attachment"></span></span>
                            </div>
                            <div class="todoText">
                                We need 2 different concepts for a software
                                page in our programm. I've attached 2 concepts
                                that will give you an idea to reproduce but
                                with a new look and feel. We'd like to keep
                                the colors similar but you can add different
                                colors. 
                            </div>
                            <div class="todoFooter">
                                <img src="assets/images/avatars/avatar3.jpg">
                            </div>
                        </div>

                    </div>
                </div>

                <div id="mainBox_progress">
                    <div class="secBodyHeader">
                        <h3>In progress</h3>
                        <span id="progress_todo">1</span>
                    </div>
                    <div class="secBodyAdd">+</div>
                    <div class="content" ondrop="drop(event)" ondragover="allowDrop(event)">

                        <div class="todoBox" draggable="true" touchstart="drag(event)" ondragstart="drag(event)" id="todo3">
                            <div class="todoHeader">
                                <div class="titleBox">
                                    <span class="dot">.</span>
                                    <span class="title">Design</span>
                                </div>
                                <span class="icon"><span class="iconify" data-icon="iconoir:attachment"></span></span>
                            </div>
                            <div class="todoText">
                                We need 2 different concepts for a software
                                page in our programm. I've attached 2 concepts
                                that will give you an idea to reproduce but
                                with a new look and feel. We'd like to keep
                                the colors similar but you can add different
                                colors. 
                            </div>
                            <div class="todoFooter">
                                <img src="assets/images/avatars/avatar4.jpg">
                                <img src="assets/images/avatars/avatar5.jpg">
                            </div>
                        </div>

                    </div>
                </div>

                <div id="mainBox_completed">
                    <div class="secBodyHeader">
                        <h3>Completed</h3>
                        <span id="completed_todo">0</span>
                    </div>
                    <div class="secBodyAdd">+</div>
                    <div class="content" ondrop="drop(event)" ondragover="allowDrop(event)">

                    </div>
                </div>

            </div>
        </section>

    </div>

    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/move-box.js') }}"></script>    
</body>
</html>