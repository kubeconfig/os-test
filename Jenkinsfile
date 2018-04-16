pipeline {
  agent any
  stages {
    stage('test') {
      steps {
        sh '''# Build image
#oc start-build test-nginx --from-dir=containers/nginx --commit=v2 -n ${namespace}
#oc new-app containers/nginx --strategy=docker'''
        sh '''# Build
export ENV=test
export TAG="${ENV}"

oc new-app -f ${template} -p APPLICATION_NAME=${ENV}-${app}-${BUILD_NUMBER} -p IMG_TAG=${TAG} -p MYSQL_DB_SETUP=YES -p NAMESPACE=${namespace} -p SOURCE_REPOSITORY_URL=${github_repo} -n ${namespace} --dry-run -o yaml | oc apply -f - -n ${namespace}
#oc start-build ${ENV}-${app}-nginx -n ${namespace}
#oc start-build ${ENV}-${app}-phpfpm -n ${namespace}'''
        input 'Continue?'
        sh '''# Cleanup
export ENV=test

oc delete all -l app=${ENV}-${app}-${BUILD_NUMBER} -n ${namespace}'''
      }
    }
    stage('stage') {
      steps {
        sh '''# Build
export ENV=staging
export TAG="${ENV}"

oc new-app -f ${template} -p APPLICATION_NAME=${ENV}-${app}-${BUILD_NUMBER} -p IMG_TAG=${TAG} -p MYSQL_DB_SETUP=YES -p NAMESPACE=${namespace} -p SOURCE_REPOSITORY_URL=${github_repo} -n ${namespace} --dry-run -o yaml | oc apply -f - -n ${namespace}
#oc start-build ${ENV}-${app}-nginx -n ${namespace}
#oc start-build ${ENV}-${app}-phpfpm -n ${namespace}'''
        input 'Continue?'
        sh '''# Cleanup
export ENV=staging
oc delete all -l app=${ENV}-${app}-${BUILD_NUMBER} -n ${namespace}
'''
      }
    }
  }
  environment {
    app = 'een-random-app'
    namespace = 'bnnvara'
    template = 'templates/mysql-template.yaml'
    github_repo = 'https://github.com/ferrymanders/os-test.git'
  }
}