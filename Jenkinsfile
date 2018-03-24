pipeline {
  agent any
  stages {
    stage('test') {
      steps {
        sh 'oc login https://openshift-master.nosopenshifttest.os.nos.aws.npocloud.nl:8443 --token=itT5u4nkWW9E6ED-6OlgKe12b9Yg482ACYqPY2chjP0 --insecure-skip-tls-verify'
      }
    }
  }
}