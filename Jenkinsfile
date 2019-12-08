#!groovy

pipeline {
    agent {
        node {
            label 'laravel57-unitTest'
        }
    }
    options {
        timestamps()
        timeout(time: 1, unit: 'HOURS')
    }

    environment {
        componentName = "UNIT Test"
        buildType = getBuildJobType()
        MajorMinorPatch = getVersion()
        componentVersion = "${MajorMinorPatch}.${BUILD_ID}"
        artifactsFilter = "${componentName}-${componentVersion}.tar.gz"
    }

    stages {
        stage('Environment') {
            steps {
                sh "printenv | sort"
                script {
                    if (buildType != 'CI') {
                        currentBuild.displayName="#${BUILD_ID} - ${componentVersion} - ${BRANCH}"
                    }
                }
            }
        }

        stage('Create Archive') {
            steps {
                createTarArchive()
            }
        }

        stage('Run Unit Tests') {
            steps {
                sh "cp .env.example .env"
                sh "composer install"
                sh "/vendor/bin/phpunit/phpunit"
                publishCoverageReport()

            }
        }

        stage('Archive Artifacts') {
            steps {

                script {
                    if (buildType ==~ /(IB|RC)/) {
                        uploadArtifacts(
                            artifactsFilter: artifactsFilter,
                            nexusPath: "${componentName}/${MajorMinorPatch}/${BUILD_ID}",
                            version: componentVersion
                        )

                        // For develop branch trigger QA deployment
                        // For master branch trigger RC deployment
                        if (BRANCH ==~ /(origin\/)?(develop|master)/) {
                            build([
                                job: "Deploy/LaravelApp",
                                parameters: [
                                    string(name: 'TARGET_ENV', value: (BRANCH ==~ /(origin\/)?develop/ ? 'qa' : 'rc')),
                                    string(name: 'VERSION', value: componentVersion)
                                ],
                                wait: false
                            ])
                        }


                    }
                }

            }
        }

    }

    post {
        always {
            notifyChannels()
        }
    }
}


void getBuildJobType(Map parameters = [:]) {
    echo "job name is: ${env.JOB_NAME}"
    parameters.buildPath = parameters.buildPath ?: env.JOB_NAME

    try {
        println "Extracting buildType from '${parameters.buildPath}'"
        return  (parameters.buildPath =~ /\/(CI|AUT|INC|IB|RC)\//)[ 0 ] [ 1 ]
    }
    catch (ex)
    {
        return 'CI'
    }
}

void publishCoverageReport() {
  publishHTML (target: [
      allowMissing: false,
      alwaysLinkToLastBuild: false,
      keepAll: true,
      reportDir: 'coverage',
      reportFiles: 'index.html',
      reportName: "RCov Report"
    ])
}

void notifyChannels() {

}