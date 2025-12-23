pipeline {
    agent any
    options {
        ansiColor('xterm')
        skipStagesAfterUnstable()
    }
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Composer Install') {
            steps {
                script {
                    if (isUnix()) {
                        sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                    } else {
                        bat 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                    }
                }
            }
        }

        stage('NPM Install & Build') {
            steps {
                script {
                    if (fileExists('package.json')) {
                        if (isUnix()) {
                            sh 'npm ci --silent || npm install --no-audit --no-fund'
                            sh 'npm run build --if-present'
                        } else {
                            bat 'npm ci --silent || npm install --no-audit --no-fund'
                            bat 'npm run build --if-present'
                        }
                    } else {
                        echo 'No package.json found — skipping npm steps.'
                    }
                }
            }
        }

        stage('Run Tests') {
            steps {
                script {
                    if (fileExists('vendor/bin/phpunit') || fileExists('vendor\\bin\\phpunit')) {
                        if (isUnix()) {
                            sh './vendor/bin/phpunit --configuration phpunit.xml'
                        } else {
                            bat 'vendor\\bin\\phpunit --configuration phpunit.xml'
                        }
                    } else {
                        echo 'phpunit not installed — skipping tests.'
                    }
                }
            }
        }
    }
    post {
        always {
            archiveArtifacts artifacts: 'public/build/**,storage/logs/**', allowEmptyArchive: true
            echo 'Pipeline finished.'
        }
    }
}
