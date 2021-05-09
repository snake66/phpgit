<?php declare(strict_types=1);

namespace PhpGit\Changelog\Formatter;

use PhpGit\Changelog\GitChangeLog;
use PhpGit\Changelog\ItemFormatterInterface;
use function stripos;
use function strpos;

/**
 * Class AbstractFormatter
 * @package PhpGit\Changelog\Formatter
 */
abstract class AbstractFormatter implements ItemFormatterInterface
{
    /**
     * @param string $msg
     *
     * @return string
     */
    public function matchGroup(string $msg): string
    {
        if (stripos($msg, 'fix') === 0) {
            return 'Fixed';
        }

        if (stripos($msg, 'up') === 0 || stripos($msg, 'add') === 0) {
            return 'Update';
        }

        if (stripos($msg, 'feat') === 0 || stripos($msg, 'new') === 0) {
            return 'Feature';
        }

        return GitChangeLog::OTHER_GROUP;
    }

    /**
     * @param array $item each line item {@see GitChangeLog::LOG_ITEM}
     *
     * @return string[] returns [group, line string]
     */
    abstract public function format(array $item): array;
}
