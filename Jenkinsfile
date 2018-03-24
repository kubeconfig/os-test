pipeline {
  agent any
  stages {
    stage('test') {
      steps {
        sh '''oc login https://openshift-master.nosopenshifttest.os.nos.aws.npocloud.nl:8443 --token=itT5u4nkWW9E6ED-6OlgKe12b9Yg482ACYqPY2chjP0 --insecure-skip-tls-verify

oc new-app -f app-template.yaml -p APPLICATION_NAME=test-app -p NAME=nginx -p NAMESPACE=ferry -p SOURCE_REPOSITORY_URL=https://github.com/ferrymanders/demo-site.git -n ferry --dry-run -o yaml | oc apply -f - -n ferry


'''
      }
    }
  }
}