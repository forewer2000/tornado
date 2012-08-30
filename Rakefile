PROJECT = 'prosak'
PROJECT_VERSION = '1.0.0a'
BOOTSTRAP_FILE = "core/tests/bootstrap.php"
TESTS_PATH = "core/tests"

##############################################################################

desc "Run unit tests"
task :tests do |t, args|
    FileList["#{TESTS_PATH}/**/*#{args.group}*Test.php"].each do |u|
        sh %{phpunit --colors --verbose --bootstrap #{BOOTSTRAP_FILE} #{u}}
    end
end

