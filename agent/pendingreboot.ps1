$ComputerName = $env:COMPUTERNAME

$PendingReboot = $false

$HKLM = [UInt32] "0x80000002"
$WMI_Reg = [WMIClass] "\\$ComputerName\root\default:StdRegProv"

if ($WMI_Reg) {
	if (($WMI_Reg.EnumKey($HKLM,"SOFTWARE\Microsoft\Windows\CurrentVersion\Component Based Servicing\")).sNames -contains 'RebootPending') {$PendingReboot = $true}
	if (($WMI_Reg.EnumKey($HKLM,"SOFTWARE\Microsoft\Windows\CurrentVersion\WindowsUpdate\Auto Update\")).sNames -contains 'RebootRequired') {$PendingReboot = $true}

	#Checking for SCCM namespace
	$SCCM_Namespace = Get-WmiObject -Namespace ROOT\CCM\ClientSDK -List -ComputerName $ComputerName -ErrorAction Ignore
	if ($SCCM_Namespace) {
		if (([WmiClass]"\\$Computer\ROOT\CCM\ClientSDK:CCM_ClientUtilities").DetermineIfRebootPending().RebootPending -eq $true) {$PendingReboot = $true}
	}
	
	$lastChecked = Get-Date -Format("yyyy-MM-dd HH:mm:ss")
	
	$xml += "<PENDINGREBOOT>`n"
	$xml += "<PENDING_REBOOT>" + $PendingReboot + "</PENDING_REBOOT>`n"
	$xml += "<LAST_CHECKED>" + $lastChecked + "</LAST_CHECKED>`n"
	$xml += "</PENDINGREBOOT>`n" 
	Write-Output $xml

}
