// Learning Management System
class LearningManager {
    constructor() {
        this.currentModule = 1;
        this.modules = [
            {
                id: 1,
                title: "Module 1: Introduction",
                description: "Getting started with basics",
                duration: "10:30",
                videoUrl: "https://example.com/video1.mp4",
                objectives: ["Understand basic concepts", "Learn fundamental principles", "Complete practical exercises"],
                outcomes: ["Ability to apply concepts", "Complete assessment tasks", "Earn certificate of completion"],
                resources: ["PDF Guide", "Supplementary Videos", "Exercise Files", "External Links"],
                quizQuestions: [
                    {
                        question: "What is the main purpose of this module?",
                        options: ["Introduction", "Assessment", "Practice"],
                        correct: 0
                    },
                    {
                        question: "Which principle is most important?",
                        options: ["Basic concepts", "Advanced topics", "Practical applications"],
                        correct: 1
                    }
                ]
            },
            {
                id: 2,
                title: "Module 2: Advanced Topics",
                description: "Deep dive into concepts",
                duration: "15:45",
                videoUrl: "https://example.com/video2.mp4",
                objectives: ["Master advanced techniques", "Apply complex concepts", "Develop professional skills"],
                outcomes: ["Advanced problem solving", "Industry-ready skills", "Portfolio development"],
                resources: ["Advanced PDFs", "Case studies", "Code examples", "Tools and templates"],
                quizQuestions: [
                    {
                        question: "What distinguishes advanced from basic?",
                        options: ["Complexity", "Application", "Methodology"],
                        correct: 2
                    }
                ]
            },
            {
                id: 3,
                title: "Module 3: Practical Examples",
                description: "Real-world applications",
                duration: "12:20",
                videoUrl: "https://example.com/video3.mp4",
                objectives: ["Apply knowledge practically", "Solve real problems", "Build portfolio projects"],
                outcomes: ["Practical experience", "Job-ready skills", "Industry connections"],
                resources: ["Project templates", "Best practices guide", "Code repository", "Community access"],
                quizQuestions: [
                    {
                        question: "What makes a practical example effective?",
                        options: ["Relevance", "Clarity", "Documentation"],
                        correct: 1
                    }
                ]
            }
        ];

        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadModuleFromURL();
        if (typeof this.updateModuleNavigation === 'function') {
            this.updateModuleNavigation();
        }
        this.setupTabSystem();
    }

    setupEventListeners() {
        // Previous/Next buttons
        document.getElementById('prevValueBtn')?.addEventListener('click', () => this.previousModule());
        document.getElementById('nextValueBtn')?.addEventListener('click', () => this.nextModule());

        // Save/Clear notes
        document.getElementById('saveNotesBtn')?.addEventListener('click', () => this.saveNotes());
        document.getElementById('clearNotesBtn')?.addEventListener('click', () => this.clearNotes());

        // Start quiz
        document.getElementById('startQuizBtn')?.addEventListener('click', () => this.startQuiz());

        // Continue to next module
        document.getElementById('continueToNextBtn')?.addEventListener('click', () => this.continueToNext());
        document.getElementById('reviewModuleBtn')?.addEventListener('click', () => this.reviewModule());
    }

    loadModuleFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const moduleId = parseInt(urlParams.get('module')) || 1;

        if (moduleId > 0 && moduleId <= this.modules.length) {
            this.loadModule(moduleId);
        }
    }

    loadModule(moduleId) {
        this.currentModule = moduleId;
        const module = this.modules[moduleId - 1];

        if (!module) return;

        // Update module info
        if (document.getElementById('currentModuleTitle')) {
            document.getElementById('currentModuleTitle').textContent = module.title;
        }

        if (document.getElementById('currentModuleDesc')) {
            document.getElementById('currentModuleDesc').textContent = module.description;
        }

        // Load video
        const video = document.getElementById('learningVideo');
        if (video) {
            video.src = module.videoUrl;
        }

        // Load quiz questions
        this.loadQuizQuestions(module.quizQuestions);

        // Update progress
        this.updateModuleProgress(moduleId);

        // Show notification
        this.showNotification(`Loaded ${module.title}`);
    }

    updateModuleProgress(moduleId) {
        const progress = ((moduleId - 1) / this.modules.length) * 100;
        if (document.querySelector('.progress-fill')) {
            document.querySelector('.progress-fill').style.width = `${progress}%`;
        }
        if (document.querySelector('.progress-text')) {
            document.querySelector('.progress-text').textContent = `${Math.round(progress)}% Complete`;
        }
    }

    previousModule() {
        if (this.currentModule > 1) {
            this.loadModule(this.currentModule - 1);
        }
    }

    nextModule() {
        if (this.currentModule < this.modules.length) {
            this.loadModule(this.currentModule + 1);
        }
    }

    saveNotes() {
        const notes = document.getElementById('notesArea').value;
        if (notes.trim()) {
            localStorage.setItem(`module_${this.currentModule}_notes`, notes);
            this.showNotification('Notes saved successfully!');
        }
    }

    clearNotes() {
        document.getElementById('notesArea').value = '';
        localStorage.removeItem(`module_${this.currentModule}_notes`);
        this.showNotification('Notes cleared!');
    }

    loadQuizQuestions(questions) {
        const quizContainer = document.getElementById('quizQuestions');
        if (quizContainer) {
            quizContainer.innerHTML = '';

            questions.forEach((q, index) => {
                const questionDiv = document.createElement('div');
                questionDiv.className = 'quiz-question';
                questionDiv.innerHTML = `
                    <h6>Question ${index + 1}</h6>
                    <p>${q.question}</p>
                    <div class="quiz-options">
                        ${q.options.map((option, i) => `
                            <label class="quiz-option">
                                <input type="radio" name="question${index}" value="${i}">
                                <span>${option}</span>
                            </label>
                        `).join('')}
                    </div>
                `;
                quizContainer.appendChild(questionDiv);
            });
        }
    }

    startQuiz() {
        const questions = document.querySelectorAll('.quiz-question');
        let correct = 0;
        let currentQuestion = 0;

        const showNextQuestion = () => {
            if (currentQuestion < questions.length - 1) {
                currentQuestion++;
                this.showQuestion(currentQuestion);
            } else {
                this.showQuizResults();
            }
        };

        const showQuestion = (index) => {
            questions.forEach((q, i) => {
                q.style.display = i === index ? 'block' : 'none';
            });
        };

        const checkAnswer = () => {
            const selected = document.querySelector(`input[name="question${currentQuestion}"]:checked`);
            const module = this.modules[this.currentModule - 1];

            if (selected && parseInt(selected.value) === module.quizQuestions[currentQuestion].correct) {
                correct++;
                this.showNotification('Correct!');
            } else {
                this.showNotification('Try again!');
            }
        };

        // Add submit button
        const quizContainer = document.getElementById('quizQuestions');
        const submitBtn = document.createElement('button');
        submitBtn.className = 'btn-gnosys mt-3';
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Submit Answer';
        submitBtn.onclick = () => {
            checkAnswer();
            showNextQuestion();
        };
        quizContainer.appendChild(submitBtn);

        this.showQuestion(0);
    }

    showQuizResults() {
        const module = this.modules[this.currentModule - 1];
        const totalQuestions = module.quizQuestions.length;
        const score = Math.round((correct / totalQuestions) * 100);

        document.getElementById('quizProgress').innerHTML = `Progress: ${correct}/${totalQuestions}`;
        document.getElementById('quizQuestions').innerHTML = `
            <div class="quiz-results">
                <h5>Quiz Complete!</h5>
                <p>Your Score: <strong>${score}%</strong></p>
                <div class="result-actions">
                    <button class="btn-gnosys-outline" onclick="location.reload()">
                        <i class="fas fa-redo"></i> Retake Quiz
                    </button>
                    <button class="btn-gnosys" onclick="learningManager.nextModule()">
                        <i class="fas fa-arrow-right"></i> Next Module
                    </button>
                </div>
            </div>
        `;

        this.showModuleCompleteModal(score);
    }

    showModuleCompleteModal(score) {
        const modal = document.getElementById('moduleCompleteModal');
        const time = new Date().toLocaleTimeString();

        document.getElementById('completionTime').textContent = time;
        document.getElementById('completionScore').textContent = `${score}%`;

        // Show modal
        modal.classList.add('show');
    }

    setupTabSystem() {
        const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
        const panes = document.querySelectorAll('.tab-pane');

        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = tab.getAttribute('data-bs-target');

                // Hide all panes
                panes.forEach(pane => pane.classList.remove('show', 'active'));

                // Remove active from all tabs
                tabs.forEach(t => t.classList.remove('active'));

                // Show target pane
                const targetPane = document.querySelector(targetId);
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                }

                // Add active to clicked tab
                tab.classList.add('active');
            });
        });
    }

    showNotification(message) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'video-notification';
        notification.textContent = message;
        document.body.appendChild(notification);

        // Show notification
        setTimeout(() => notification.classList.add('show'), 100);

        // Hide notification after 2 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 2000);
    }
}

// Initialize learning system when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.learningManager = new LearningManager();

    // Initialize AOS for learning page
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 100
    });
});
