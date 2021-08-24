

package Apache::Ocsinventory::Plugins::Pendingreboot::Map;

use strict;

use Apache::Ocsinventory::Map;

$DATA_MAP{pendingreboot} = {
		mask => 0,
		multi => 1,
		auto => 1,
		delOnReplace => 1,
		sortBy => 'LAST_CHECKED',
		writeDiff => 0,
		cache => 0,
		fields => {
                PENDING_REBOOT => {},
				LAST_CHECKED => {}
	}
};
1;
