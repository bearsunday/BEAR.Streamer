# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.4.0] - 2025-11-22

### Added
- Add PHP 8.4 support

### Changed
- Move Stream qualifier to parameter level (#14)
- Ensure $view is an instance of Stringable
- Update phpstan to v2.0
- Update doctrine coding standard to v12

### Fixed
- Ignore code coverage for HTTP response code setting
- Remove redundant is_string check and cast view to string

### Removed
- Remove maglnet/composer-require-checker

## [1.3.0] - 2024-06-09

### Added
- Add PHP 8.3 support

### Changed
- Drop PHP 7.x support

## [1.2.2] - 2021-03-07

### Fixed
- Fix PHP 8 compatibility issues (#9)

## [1.2.1] - 2021-01-16

### Changed
- Add more type info
- Strict phpstan/psalm rules

## [1.2.0] - 2021-01-14

### Added
- Support PHP 8.0

### Changed
- Drop PHP 7.2 support (EOL)
- Switch from TravisCI to GitHub Actions

## [1.1.0] - 2020-04-09

### Added
- Support PHP 7.2, 7.3 and 7.4

### Changed
- Refactor with newer version of phpstan and psalm

## [1.0.1] - 2017-10-15

### Fixed
- Fix GC issues (#2)
- Respect status code (#3)

## [1.0.0] - 2017-08-26

### Added
- Initial stable release

[Unreleased]: https://github.com/bearsunday/BEAR.Streamer/compare/1.4.0...HEAD
[1.4.0]: https://github.com/bearsunday/BEAR.Streamer/compare/1.3.0...1.4.0
[1.3.0]: https://github.com/bearsunday/BEAR.Streamer/compare/1.2.2...1.3.0
[1.2.2]: https://github.com/bearsunday/BEAR.Streamer/compare/1.2.1...1.2.2
[1.2.1]: https://github.com/bearsunday/BEAR.Streamer/compare/1.2.0...1.2.1
[1.2.0]: https://github.com/bearsunday/BEAR.Streamer/compare/1.1.0...1.2.0
[1.1.0]: https://github.com/bearsunday/BEAR.Streamer/compare/1.0.1...1.1.0
[1.0.1]: https://github.com/bearsunday/BEAR.Streamer/compare/1.0.0...1.0.1
[1.0.0]: https://github.com/bearsunday/BEAR.Streamer/releases/tag/1.0.0
