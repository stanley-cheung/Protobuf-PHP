# encoding: utf-8

namespace :doc do

  desc "Generate manual"
  task :build do
    version = ENV['version']
    ENV['RONN_MANUAL'] = "Protobuf-PHP #{version}"
    ENV['RONN_ORGANIZATION'] = "Ivan -DrSlump- Montes"
    sh "ronn -w -s toc -r5 --markdown man/*.ronn"
  end

  desc 'Publish to github pages'
  task :github => 'doc:build' do
    require 'git'
    require 'logger'

    remote = `git remote show origin`
             .split(%r{\n})  # Ruby 1.9 only has grep() on Array
             .grep(/Push.*URL/)
             .first[/git@.*/]

    files = [
      'protoc-gen-php.1.html',
      'protobuf-php.3.html',
      'protobuf-php.5.html',
    ]

    root = "/tmp/checkout-#{Time.now.to_i}"
    g = Git.clone(remote, root, :log => Logger.new(STDOUT))

    # Make sure this actually switches branches.
    g.checkout(g.branch('gh-pages'))
    
    files.each {|file|
      cp "man/#{file}", "#{root}/."
      g.add(file)
    }

    g.commit('Regenerating Github Pages.')

    # PUSH!
    g.push(g.remote('origin'), g.branch('gh-pages'))

    puts '--> GitHub Pages Commit and Push successful.'
  end

end


